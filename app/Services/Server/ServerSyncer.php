<?php

namespace App\Services\Log;

use App\Models\Channels\Channel;
use App\Models\Settings\Category;
use App\Models\Settings\Country;
use App\Models\Settings\Server;
use Telegram\Bot\Laravel\Facades\Telegram;

class ServerSyncer
{
    public function telegram(string $message, ?int $chatId = null): void
    {
        $chatId = $chatId ?? config('telegram.base_chat_id');

        try {
            Telegram::setTimeout(5)->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
            ]);
        } catch (\Exception $e) {
            //
        }
    }

    public function syncCategories()
    {
        $categories = Category::where('is_active')->get();
        $syncingData = [];
        /**
         * @var Category
         */
        foreach ($categories as $category) {
            $syncingData[] = [
                'id' => $category->id,
                'name' => $category->name,
                'order' => $category->index,
                'parent' => $category->is_parental_control,
            ];
        }

        $this->syncWithAllServers('settings', 'packets', $syncingData);
    }

    public function syncCountries()
    {
        $countries = Country::where('is_active')->get();
        $syncingData = [];
        /**
         * @var Country
         */
        foreach ($countries as $country) {
            $syncingData[] = [
                'id' => $country->code,
                'name' => $country->name,
            ];
        }
        $this->syncWithAllServers('settings', 'country', $syncingData);
    }

    public function syncExternalChannels()
    {
        $external = Channel::where('is_external', true)
            ->where('is_active', true)
            ->get();
        $syncingData = [];
        /**
         * @var Channel
         */
        foreach ($external as $channel) {
            $syncingData[] = [
                'id' => $channel->id,
                'name' => $channel->name,
                'epg' => $channel->epg_key,
                'packet' => $channel->category_id,
                'smartiptv' => $channel->smartiptv,
                'ssiptv' => $channel->ssiptv,
                'test' => (int) $channel->is_test,
                'hevc' => (int) $channel->is_hevc,
                'logo' => $channel->logo,
                'level' => $channel->tariff_id,
                'url' => $channel->url,
                'corder' => $channel->index,
            ];
        }

        $this->syncWithAllServers('external', 'channels', $syncingData);
    }

    public function syncChannels()
    {
        $external = Channel::where('is_external', false)
            ->where('is_active', true)
            ->get();
        $syncingData = [];
        /**
         * @var Channel
         */
        foreach ($external as $channel) {
            $syncingData[] = [
                'id' => $channel->id,
                'name' => $channel->name,
                'epg' => $channel->epg_key,
                'packet' => $channel->category_id,
                'smartiptv' => $channel->smartiptv,
                'ssiptv' => $channel->ssiptv,
                'test' => (int) $channel->is_test,
                'hevc' => (int) $channel->is_hevc,
                'logo' => $channel->logo,
                'level' => $channel->tariff_id,
                //'url' => $channel->url,
                'corder' => $channel->index,
                'dvr' => (int) $channel->dvr,
            ];
        }
        $this->syncWithAllServers('internal', 'channels', $syncingData);
    }

    protected function syncWithAllServers(string $type, string $name, array $data)
    {
        $servers = Server::where('is_active', 1)->get();
        /**
         * @var Server
         */
        foreach ($servers as $server) {
            $this->sync($server, $type, $name, $data);
        }
    }

    public function sync(Server $server, string $type, string $name, mixed $data)
    {
        if ($data == 'delete') {
            $send['data']['delete'] = $name;
            $send['count'] = 1;
        } elseif (count($data) > 0) {
            $send['data'][$name] = $data;
            $send['count'] = count($data);
        }
        $send['type'] = $type;
        $send['data'] = gzencode(serialize($send['data']), 9);
        $send['hash'] = hash_hmac('md5', $send['data'], '98ym3a5g527g6h972ji8l3;p;re');
        $send = http_build_query($send);
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($send) . "\r\n",
                'method' => 'POST',
                'content' => $send,
            ],
        ];
        //$result = file_get_contents($server->address, false, stream_context_create($options));
        if ($result === false) {
            //not synced
        } else {
            // $_SESSION['message'][1][]= date('Y-m-d H:i:s').' | '.$item['name'].' | Sended <b>'.$type.' : '.$name.' ('.count($data).')</b>.';
            // $_SESSION['message'][1][]=$result;
        }
        unset($result);
    }

    // if (isset($_GET['filename']) && isset($files) && isset($files[$_GET['filename']]) && isset($_POST['post_file_sub']) && $_POST['title']!='' && $_POST['sub-title']!='' && $_POST['description']!='') { // Публикация
    // 	$tmp=strtotime('+1 month');
    // 	$tmp_time=time();
    // 	if ($sql->query("UPDATE `billing_files` SET `time-to-die`='".$tmp."' WHERE `filename`='".strip_tags($_GET['filename'])."'")) {
    // 		$_SESSION['message'][1][]=date('Y-m-d H:i:s').' | Admin. <b>'.strip_tags($_GET['filename']).'</b>: <i>Time to die</i> успешно обновлено.';
    // 		$sql->query("INSERT INTO `billing_history` SET `login`='".$_SESSION['email']."', `time`='".time()."', `notice`='Admin. Public <b>".strip_tags($_GET['filename'])."</b>.', `ip`='".$client_ip_address."'");
    // 	}
    // 	$data=$files[strip_tags($_GET['filename'])];
    // 	$data['time-to-die']=$tmp;
    // 	SyncWithServer('file', $_GET['filename'], $data);
    // 	$sql1->query("DELETE FROM `dbs_epg` WHERE `channel`='".strip_tags($_GET['filename'])."'");
    // 	$sql1->query("DELETE FROM `dbs_channels` WHERE `epg`='".strip_tags($_GET['filename'])."'");
    // 	$sql1->query("INSERT INTO `dbs_channels` SET `epg`='".strip_tags($_GET['filename'])."', `type`='vod', `dvr`='0'");
    // 	for ($i=$tmp_time; $i<$tmp; $i=$i+86400) {
    // 		$sql1->query("INSERT INTO `dbs_epg` SET `channel`='".strip_tags($_GET['filename'])."', `start`='".$i."', `stop`='".($i+86400)."', `title`='".htmlentities(trim(preg_replace('/\s+/', ' ', $_POST['title'])), ENT_QUOTES|ENT_HTML401, "UTF-8", TRUE)."', `subtitle`='".htmlentities(trim(preg_replace('/\s+/', ' ', $_POST['sub-title'])), ENT_QUOTES|ENT_HTML401, "UTF-8", TRUE)."', `desc`='".htmlentities(trim(preg_replace('/\s+/', ' ', $_POST['description'])), ENT_QUOTES|ENT_HTML401, "UTF-8", TRUE)."', `lang`='ru'");
    // 	}
    // 	header('Location: vod.php?filename='.strip_tags($_GET['filename']), true, 303); exit;
    // }
    // if (isset($_GET['filename']) && isset($files) && isset($files[$_GET['filename']]) && isset($_POST['delete_file_sub'])) { // Удаление
    // 	$sql->query("DELETE FROM `billing_files` WHERE `filename`='".strip_tags($_GET['filename'])."'");
    // 	if ($sql->affected_rows==1) {
    // 		$_SESSION['message'][1][]=date('Y-m-d H:i:s').' | Admin. <b>'.strip_tags($_GET['filename']).'</b>: успешно удален.';
    // 		$sql->query("INSERT INTO `billing_history` SET `login`='".$_SESSION['email']."', `time`='".time()."', `notice`='Admin. Delete <b>".strip_tags($_GET['filename'])."</b>.', `ip`='".$client_ip_address."'");
    // 	}
    // 	SyncWithServer('file', $_GET['filename'], 'delete');
    // 	header('Location: vod.php', true, 303); exit;
    // }
}
