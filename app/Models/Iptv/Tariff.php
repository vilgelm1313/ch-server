<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tariff
 *
 * @property string $name
 * @property float $price
 * @property bool $is_active
 */
class Tariff extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_active',
        'price',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
