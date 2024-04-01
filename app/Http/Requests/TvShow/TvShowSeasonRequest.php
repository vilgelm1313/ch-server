<?php

namespace App\Http\Requests\TvShow;

use App\Http\Requests\BaseRequest;

class TvShowSeasonRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
        ];

        return $rules;
    }
}
