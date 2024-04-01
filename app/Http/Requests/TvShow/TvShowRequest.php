<?php

namespace App\Http\Requests\TvShow;

use App\Http\Requests\BaseRequest;

class TvShowRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'poster' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'original_title' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
            'show_start' => 'required|date_format:Y-m-d',
            'show_end' => 'required|date_format:Y-m-d',
            'is_active' => 'required|boolean',
        ];

        return $rules;
    }
}
