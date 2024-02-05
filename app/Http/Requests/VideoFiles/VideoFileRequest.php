<?php

namespace App\Http\Requests\VideoFiles;

use App\Http\Requests\BaseRequest;

class VideoFileRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'path' => 'required|string|max:255',
            'poster' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'original_title' => 'nullable|string|max:255',
            'kinopoisk_url' => 'nullable|string|max:255',
            'imbd' => 'nullable|numeric',
            'kinopoisk' => 'nullable|numeric',
            'description' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'show_start' => 'required|date_format:Y-m-d',
            'show_end' => 'required|date_format:Y-m-d',
            'year' => 'nullable|integer',
            'country' => 'nullable|string|max:255',
            'director' => 'nullable|string|max:255',
            'actors' => 'nullable|string',
        ];

        return $rules;
    }
}
