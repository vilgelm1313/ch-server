<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;

class BanpIpRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'ip' => 'required|string|max:255',
        ];

        return $rules;
    }
}
