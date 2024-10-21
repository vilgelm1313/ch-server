<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;

class BanDomainRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'domain' => 'required|string|max:255',
        ];

        return $rules;
    }
}
