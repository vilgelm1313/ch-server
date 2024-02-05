<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{
    public function rules(): array
    {
        $rules = [
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username',
            ],
            'is_active' => 'required|boolean',
            'password' => 'required|string|min:8|confirmed',
            'comment' => 'nullable|string|max:255',
        ];

        if ($this->method() === 'PUT') {
            $rules['password'] = 'nullable|string|min:8|confirmed';
            $rules['username'][3] = Rule::unique('users', 'username')->ignore($this->id);
        }

        return $rules;
    }
}
