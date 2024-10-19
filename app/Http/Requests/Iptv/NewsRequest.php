<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;

class NewsRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'index' => 'required|string',
            'is_active' => 'required|boolean',
        ];

        return $rules;
    }
}
