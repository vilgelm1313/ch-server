<?php

namespace App\Http\Requests\Channels;

use App\Http\Requests\BaseRequest;

class ChannelRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string|max:255',
            'logo' => 'nullable|string|max:255',
            'categories' => 'nullable',
            'categories.*' => 'integer|exists:categories,id',
            'country_id' => 'nullable|integer',
            'smartiptv' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255|url',
            'dvr' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'is_external' => 'nullable|boolean',
        ];

        return $rules;
    }
}
