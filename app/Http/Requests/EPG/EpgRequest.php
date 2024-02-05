<?php

namespace App\Http\Requests\EPG;

use App\Http\Requests\BaseRequest;

class EpgRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'key' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'lang' => 'nullable|string|max:255',
            'event' => 'nullable|string|max:255',
        ];

        return $rules;
    }
}
