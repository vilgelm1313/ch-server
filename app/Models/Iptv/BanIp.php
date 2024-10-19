<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BanIp
 *
 * @property string $ip
 */
class BanIp extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'ip',
    ];
}
