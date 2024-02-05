<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ConfigurationRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'key' => [
                'required',
                'string',
                'max:255',
                'unique:configurations',
            ],
            'value' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];

        if ($this->method() === 'PUT') {
            $rules['key'][3] = Rule::unique('configurations', 'key')->ignore($this->id);
        }

        return $rules;
    }
}
