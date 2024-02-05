<?php

namespace App\Listeners\Model;

use App\Events\Model\ModelUpdated;

class LogModelUpdated extends LogModel
{
    /**
     * Handle the event.
     */
    public function handle(ModelUpdated $event): void
    {
        $model = $event->model;
        $message = $this->getBaseParams('update', $model);

        $message['new'] = $model->toArray();
        $message['old'] = $event->oldAttributes;
        $this->loggerService->database($message);
    }
}
