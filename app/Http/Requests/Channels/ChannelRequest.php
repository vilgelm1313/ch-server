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
            'category_id' => 'required|integer',
            'country_id' => 'nullable|integer',
            'epg_key' => 'required|string|max:255',
            'smartiptv' => 'nullable|string|max:255',
            'ssiptv' => 'nullable|string|max:255',
            'index' => 'required|integer',
            'tariff_id' => 'required|integer',
            'is_test' => 'required|boolean',
            'url' => 'nullable|string|max:255|url',
            'dvr' => 'nullable|integer',
            'is_hevc' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_external' => 'required|boolean',
        ];

        return $rules;
    }
}
