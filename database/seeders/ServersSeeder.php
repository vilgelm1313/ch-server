<?php

namespace Database\Seeders;

use App\Models\Settings\Server;

class ServersSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $c = Server::where('name', $item['name'])->first();
        if (!$c) {
            $c = new Server();
            $c->name = $item['name'];
        }
        $c->address = $item['url'];
        $c->save();
    }

    public function getFileName(): string
    {
        return 'servers';
    }
}
