<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseRequest;

class EpgSettingRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'refresh_period' => 'required|integer',
        ];

        return $rules;
    }
}
