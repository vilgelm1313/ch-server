<?php

namespace App\Listeners\Model;

use App\Events\Model\ModelDestroyed;

class LogModelDestroyed extends LogModel
{
    /**
     * Handle the event.
     */
    public function handle(ModelDestroyed $event): void
    {
        $model = $event->model;
        $message = $this->getBaseParams('destroy', $model);

        $this->loggerService->database($message);
    }
}
