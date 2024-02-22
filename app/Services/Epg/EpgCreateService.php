<?php

namespace App\Services\Epg;

use App\Models\EPG\Epg;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class EpgCreateService
{
    public function run()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><!DOCTYPE tv SYSTEM "xmltv.dtd"><tv></tv>');

        $programmes = Epg::where('start', '>', Carbon::now())
            ->whereHas('channel')
            ->with('channel')
            ->get();

        /**
         * @var Epg
         *
         */
        foreach ($programmes as $programme) {
            $p = $xml->addChild('programme');
            $p->addAttribute('start', $programme->start->format('YmdHis'));
            $p->addAttribute('stop', $programme->end->format('YmdHis'));
            $p->addAttribute('start_unix', $programme->start->timestamp);
            $p->addAttribute('stop_unix', $programme->end->timestamp);
            $p->addAttribute('channel', $programme->channel->sync_epg_key);
            $title = $programme->addChild('title', html_entity_decode($programme->title, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
            if ($programme->language) {
                $title->addAttribute('lang', $programme->language);
            }
            if ($programme->sub_title) {
                $subtitle = $p->addChild('sub-title', html_entity_decode($programme->sub_title, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
                if ($programme->language) {
                    $subtitle->addAttribute('lang', $programme->language);
                }
            }
            if ($programme->description) {
                $description = $p->addChild('desc', html_entity_decode($programme->description, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
                if ($programme->language) {
                    $description->addAttribute('lang', $programme->language);
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
    }
}
