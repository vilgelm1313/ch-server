<?php

namespace App\Listeners\Model;

use App\Models\BaseModel;
use App\Services\Log\LoggerService;
use Illuminate\Support\Str;

abstract class LogModel
{
    public function __construct(protected LoggerService $loggerService)
    {

    }

    protected function getBaseParams(string $action, BaseModel $model): array
    {
        return [
            'type' => 'model',
            'action' => $action,
            'class' => Str::afterLast(get_class($model), '\\'),
            'id' => $model->getKey(),
        ];
    }
}
