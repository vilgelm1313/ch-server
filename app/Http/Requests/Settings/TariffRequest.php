<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseRequest;

class TariffRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'index' => 'required|integer',
            'is_active' => 'required|boolean',
        ];

        return $rules;
    }
}
