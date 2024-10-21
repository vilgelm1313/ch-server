<?php

namespace App\Http\Requests\Iptv;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class DealerRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('dealers', 'email')
                    ->where('video_server_id', $this->video_server_id)
                    ->ignore($this->id)
            ],
            'password' => 'required|confirmed',
            'iptv_price' => 'required|numeric|min:0',
            'playlist_price' => 'required|numeric|min:0',
            'comment' => 'nullable|string',
            'is_active' => 'required|boolean',
            'video_server_id' => 'required|exists:video_servers,id',
        ];

        if ($this->method() === 'PUT') {
            $rules['password'] = 'nullable|string';
        }

        return $rules;
    }
}
