<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class VideoServer
 *
 * @property string $name
 * @property string $epg_src
 * @property string $logo_src
 * @property boolean $is_maintenence
 * @property integer $session_timeout
 * @property integer $timeout
 * @property integer $token_lifetime
 * @property string $mail_from
 * @property string $mail_host
 * @property string $mail_user
 * @property string $mail_password
 * @property string $timezone
 * @property string $apk_version
 * @property string $apk_changes
 * @property string $apk_src
 * @property boolean $mail_encryption
 * @property bool $is_active
 */
class VideoServer extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_active',
        'session_timeout',
        'timezone',
        'timeout',
        'mail_from',
        'mail_host',
        'mail_password',
        'mail_user',
        'epg_src',
        'logo_src',
        'is_maintenence',
        'token_lifetime',
        'mail_encryption',
        'apk_version',
        'apk_src',
        'apk_changes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'mail_encryption' => 'boolean',
        'is_maintenence' => 'boolean',
    ];
}
