<?php

namespace App\Services\Server;

use App\Models\Settings\Server;
use App\Services\Log\LoggerService;
use App\Services\Server\Syncers\ExternalChannelSyncer;
use App\Services\Server\Syncers\ServerSyncerContract;

class ServerSyncer
{
    public function __construct(protected LoggerService $loggerService)
    {
        
    }

    public function sync(Server $server, string $type): void
    {
        $syncer = $this->getSyncer($type);
        $data = $syncer->getData($server);

        $this->upload($server, $syncer->getType(), $syncer->getName(), $data);

        if ($type === 'channel') {
            $syncer = app()->make(ExternalChannelSyncer::class);
            $this->upload($server, $syncer->getType(), $syncer->getName(), $data);
        }
    }

    protected function getSyncer(string $type): ServerSyncerContract
    {
        $class = ucfirst($type);
        $name = "App\\Services\\Server\\Syncers\\{$class}Syncer";

        return new $name;
    }

    public function upload(Server $server, string $type, string $name, mixed $data)
    {
        $server->address = null;
        if ($data == 'delete') {
            $send['data']['delete'] = $name;
            $send['count'] = 1;
        } elseif (count($data) > 0) {
            if ($name) {
                $send['data'][$name] = $data;
            } else {
                $send['data'] = $data;
            }
            
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
        $this->loggerService->database([
            'type' => 'sync',
            'action' => 'start',
            'info' => [
                'name' => $name,
                'type' => $type,
                'server' => $server->name,
            ]
        ]);
        $result = null;
        if (!$result === false) {
            $this->loggerService->database([
                'type' => 'sync',
                'action' => 'fail',
                'info' => [
                    'name' => $name,
                    'type' => $type,
                    'server' => $server->name,
                ]
            ]);
        } else {
            $this->loggerService->database([
                'type' => 'sync',
                'action' => 'fail',
                'info' => [
                    'name' => $name,
                    'type' => $type,
                    'data' => $result,
                    'server' => $server->name,
                ]
            ]);
        }
    }
}
