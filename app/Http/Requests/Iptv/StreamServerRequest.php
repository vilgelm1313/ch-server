<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;

class StreamServerRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'index' => 'required|integer|min:0',
            'address' => 'required|string',
            'port' => 'required|integer|min:0',
        ];

        return $rules;
    }
}
