<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 */
class BaseModel extends Model
{
    protected $perPage = 10;
    public const SORT_FIELDS = [];
}
