<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseRequest;

class ServerRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ];

        return $rules;
    }
}
