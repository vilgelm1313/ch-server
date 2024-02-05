<?php

namespace App\Events\Model;

use App\Models\BaseModel;

class ModelUpdated extends ModelEvent
{
    public function __construct(public BaseModel $model, public array $oldAttributes)
    {
        //
    }
}
