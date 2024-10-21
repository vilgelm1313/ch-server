<?php

namespace Database\Seeders;

use App\Models\Iptv\Dealer;
use App\Models\Iptv\Tariff;
use App\Models\Iptv\VideoServer;
use App\Models\VideoFiles\VideoFile;
use Carbon\Carbon;

class DealerSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $server = VideoServer::where('name', 'like', '4kone%')->first();
        if (!$server) {
            return;
        }

        $tariff = Tariff::where('video_server_id', $server->id)->first();

        $dealer = new Dealer();
        $dealer->email = $item['email'];
        $dealer->password = $item['pass'];
        $dealer->created_at = Carbon::createFromTimestamp($item['time_a']);
        $dealer->balance = $item['balance'];
        $dealer->is_active = (int) $item['active'];
        $dealer->comment = $item['notice'];
        $dealer->playlist_price = $item['playlist'];
        $dealer->iptv_price = round($tariff->price * $item['bonus'], 2);
        $dealer->video_server_id = $server->id;
        $dealer->save();
    }

    public function getFileName(): string
    {
        return 'user';
    }
}
