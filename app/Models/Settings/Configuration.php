<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Configuration
 *
 * @property string $key
 * @property string $value
 */
class Configuration extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];
}
