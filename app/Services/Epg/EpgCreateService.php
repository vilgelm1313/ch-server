<?php

namespace App\Services\Epg;

use App\Models\Channels\Channel;
use App\Models\EPG\Epg;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class EpgCreateService
{
    public function run()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><!DOCTYPE tv SYSTEM "xmltv.dtd"><tv></tv>');

        $channels = Channel::whereNotNull('flussonic')
            ->orWhere('flussonic', '<>', '')
            ->get();

        foreach ($channels as $channel) {
            $c = $xml->addChild('channel');
            $c->addAttribute('id', $channel->flussonic);
            $name = $c->addChild('display-name', $channel->flussonic);
        }
        $programmes = Epg::where('start', '>', Carbon::now()->subDay())
            ->whereHas('channel')
            ->with('channel')
            ->get();

        /**
         * @var Epg
         *
         */
        foreach ($programmes as $programme) {
            if (!$programme->channel->flussonic) {
                continue;
            }
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $programme->start);
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $programme->end);
            $p = $xml->addChild('programme');
            $p->addAttribute('start', $start->format('YmdHis'));
            $p->addAttribute('stop', $end->format('YmdHis'));
            $p->addAttribute('start_unix', $start->timestamp);
            $p->addAttribute('stop_unix', $start->timestamp);
            $p->addAttribute('channel', $programme->channel->flussonic);
            $fields = ['title','sub_title', 'description'];
            foreach ($fields as $field) {
                if ($programme->$field) {
                    $name = str_replace('_', '-', $field);
                    $value = htmlspecialchars(html_entity_decode($programme->$field, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
                    $child = $p->addChild($name, $value);
                    $child->addAttribute('lang', 'ru');
                }
            }
        }

        $file = 'epg/xmltv.xml';
        Storage::put($file, $xml->asXML());

        $dest = storage_path('app/' . $file . '.gz');
        $fpOut = gzopen($dest, 'wb9');
        $fpIn = fopen(storage_path('app/' . $file), 'rb');
        while (!feof($fpIn)) {
            gzwrite($fpOut, fread($fpIn, 1024 * 512)); 
        }
        fclose($fpIn);
        gzclose($fpOut);

        Http::asMultipart()
            ->attach('gz', file_get_contents(storage_path('app/' . $file . '.gz')), 'xmltv.xml.gz')
            ->post('https://plati.one/epg/save.php');
    }
}
