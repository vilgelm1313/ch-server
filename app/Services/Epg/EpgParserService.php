<?php

namespace App\Services\Epg;

use App\Models\Channels\Channel;
use App\Models\EPG\Epg;
use App\Models\Settings\EpgSetting;
use App\Services\Log\LoggerService;
use Carbon\Carbon;
use SimpleXMLElement;
use XMLReader;

class EpgParserService
{
    protected LoggerService $logger;
    protected array $channels = [];

    public function __construct(protected EpgSetting $epgSetting)
    {
        $this->logger = app()->make(LoggerService::class);
    }

    public function parse()
    {
        $reader = new XMLReader();
        $reader->open($this->epgSetting->url);

        while ($reader->read()) {

            if ($reader->nodeType !== XMLReader::ELEMENT) {
                continue;
            }
            if ($reader->name == 'channel') {
                $this->channels[$reader->getAttribute('id')] = $this->parseChannel($reader);
            } elseif ($reader->name == 'programme') {
                $this->parseProgramme($reader);
            }
        }
        $reader->close();

        $this->epgSetting->last_run = now();
        $this->epgSetting->save();
    }

    protected function parseProgramme(XMLReader $reader): void
    {
        $start = Carbon::parse($reader->getAttribute('start'));
        $stop = Carbon::parse($reader->getAttribute('stop'));

        $now = Carbon::now();
        $inTwoWeeks = Carbon::now()->addDays(15);

        if ($start->lt($now) || $start->gt($inTwoWeeks)) {
            return;
        }

        $languages = [];
        $fields = [
            'title',
            'sub-title',
            'desc',
            'category',
        ];

        $xml = simplexml_load_string($reader->readOuterXML());
        foreach ($fields as $field) {
            if (empty($xml->{$field})) {
                continue;
            }
            foreach ($xml->{$field} as $element) {
                if ($this->isEmpty($element)) {
                    continue;
                }
                $language = $this->getLanguage($element);
                if (empty($languages[$language])) {
                    $languages[$language] = [];
                }
                $stringValue = $this->getStringValue($element);
                if ($field !== 'desc') {
                    $stringValue = mb_substr($stringValue, 0, 255);
                }
                $languages[$language][$field] = $stringValue;
            }
        }

        foreach ($languages as $language => $item) {
            $channel = $this->channels[$reader->getAttribute('channel')];
            Epg::where('start', '>=', $start)
                ->where('end', '<=', $stop)
                ->where('language', $language)
                ->where('channel_id', $channel->id)
                ->delete();

            $epg = new Epg();
            $epg->start = $start;
            $epg->end = $stop;
            $epg->title = $item['title'] ?? '';
            $epg->sub_title = $item['sub-title'] ?? '';
            $epg->description = $item['desc'] ?? '';
            $epg->language = $language;
            $epg->channel_id = $channel->id;
            $epg->epg_setting_id = $this->epgSetting->id;
            $epg->save();
        }
    }

    protected function parseChannel(XMLReader $reader): Channel
    {
        $xml = simplexml_load_string($reader->readOuterXML());
        $channelName = [(string) $xml->{'display-name'}][0];
        $epgKey = $this->epgSetting->prefix . '_' . $this->getEpgKey($channelName);
        $channel = Channel::where('epg_key', $epgKey)->first();

        if (!$channel) {
            $channel = new Channel();
            $channel->name = $channelName;
            $channel->epg_key = $epgKey;
            $channel->index = 9999;
            $channel->is_active = false;
            $channel->save();

            $this->logger->database([
                'type' => 'epg',
                'action' => 'channel',
                'value' => $channel->toArray(),
            ]);
        }

        return $channel;
    }

    protected function isEmpty(SimpleXMLElement $simpleXMLElement)
    {
        return !preg_replace('/[\s\-\.]/', '', (string) $simpleXMLElement);
    }

    protected function getLanguage(SimpleXMLElement $simpleXMLElement): string
    {
        $language = 'xxx';
        if ((string) $simpleXMLElement->attributes()->lang !== null) {
            $language = (string) $simpleXMLElement->attributes()->lang;
        }

        return $language;
    }

    protected function getStringValue(SimpleXMLElement $subject)
    {
        $subject = (string) $subject;

        return html_entity_decode(trim(preg_replace('/\s+/', ' ', $subject)), ENT_COMPAT, 'UTF-8');
    }

    protected function getEpgKey(string $element): string
    {
        $subject = (string) $element;
        $subject = strip_tags($subject);
        $subject = str_replace(["\n", "\r"], '', $subject);
        $subject = preg_replace("/\s+/", ' ', $subject);
        $subject = trim($subject);
        $subject = str_replace(' ', '_', $subject);
        $subject = str_replace('+', 'plus', $subject);
        $subject = mb_strtolower($subject, 'UTF-8');
        $subject = strtr($subject, ['а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => '']);
        $subject = str_replace(['&quot;', '&amp;', '&apos;', '&lt;', '&gt;', '-', '"', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', ';', "'", ',', '.', '/', '', '~', '`', '=', "'"], '', $subject);

        return $subject;
    }
}
