<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;

class VideoServerRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'session_timeout' => 'required|integer|min:0',
            'timezone' => 'required|string',
            'timeout' => 'required|integer|min:0',
            'mail_from' => 'required|email',
            'mail_host' => 'required|string',
            'mail_password' => 'required|string',
            'mail_user' => 'required|string',
            'epg_src' => 'required|string',
            'logo_src' => 'required|string',
            'is_maintenence' => 'required|boolean',
            'token_lifetime' => 'required|integer|min:0',
            'mail_encryption' => 'required|boolean',
        ];

        return $rules;
    }
}
