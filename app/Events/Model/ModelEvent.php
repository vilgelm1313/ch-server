<?php

namespace App\Events\Model;

use App\Models\BaseModel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class ModelEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public BaseModel $model)
    {
        //
    }
}
