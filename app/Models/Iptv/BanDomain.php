<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BanDomain
 *
 * @property string $domain
 */
class BanDomain extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'domain',
    ];
}
