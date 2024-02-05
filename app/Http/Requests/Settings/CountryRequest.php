<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries', 'code'),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries', 'name'),
            ],
            'is_active' => 'required|boolean',
        ];

        if ($this->method() === 'PUT') {
            $rules['code'][3] = Rule::unique('countries', 'code')->ignore($this->id);
            $rules['name'][3] = Rule::unique('countries', 'name')->ignore($this->id);
        }

        return $rules;
    }
}
