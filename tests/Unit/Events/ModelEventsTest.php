<?php

namespace Tests\Unit\Services;

use App\Events\Model\ModelDestroyed;
use App\Events\Model\ModelStored;
use App\Events\Model\ModelUpdated;
use App\Listeners\Model\LogModelDestroyed;
use App\Listeners\Model\LogModelStored;
use App\Listeners\Model\LogModelUpdated;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ModelEventsTest extends TestCase
{
    public function testModelEvent()
    {
        Event::fake();
        Event::assertListening(
            ModelUpdated::class,
            LogModelUpdated::class
        );
        Event::assertListening(
            ModelStored::class,
            LogModelStored::class
        );
        Event::assertListening(
            ModelDestroyed::class,
            LogModelDestroyed::class
        );
    }
}
