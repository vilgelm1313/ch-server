<?php

namespace App\Providers;

use App\Events\Auth\AuthEvent;
use App\Events\Model\ModelDestroyed;
use App\Events\Model\ModelStored;
use App\Events\Model\ModelUpdated;
use App\Listeners\Auth\LogAuth;
use App\Listeners\Model\LogModelDestroyed;
use App\Listeners\Model\LogModelStored;
use App\Listeners\Model\LogModelUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ModelDestroyed::class => [
            LogModelDestroyed::class,
        ],
        ModelStored::class => [
            LogModelStored::class,
        ],
        ModelUpdated::class => [
            LogModelUpdated::class,
        ],
        AuthEvent::class => [
            LogAuth::class,
        ],
    ];
}
