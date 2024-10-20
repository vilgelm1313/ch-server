<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;

class TariffRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'price' => 'required|numeric|min:0',
            'video_server_id' => 'required|exists:video_servers,id',
        ];

        return $rules;
    }
}
