<?php

namespace App\Listeners\Model;

use App\Events\Model\ModelStored;

class LogModelStored extends LogModel
{
    /**
     * Handle the event.
     */
    public function handle(ModelStored $event): void
    {
        $model = $event->model;
        $message = $this->getBaseParams('store', $model);
        $message['value'] = $model->toArray();

        $this->loggerService->database($message);
    }
}
