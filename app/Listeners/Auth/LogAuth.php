<?php

namespace App\Listeners\Auth;

use App\Events\Auth\AuthEvent;
use App\Services\Log\LoggerService;

class LogAuth
{
    public function __construct(protected LoggerService $loggerService)
    {

    }

    public function handle(AuthEvent $event): void
    {
        $action = $event->username ? 'login attempt ' . $event->username : $event->action . ' successfully';
        $this->loggerService->database([
            'type' => 'auth',
            'action' => $action,
        ]);
    }
}
