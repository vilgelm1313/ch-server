<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{
    public function login(Request $request, AuthService $authService): JsonResponse
    {
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $user = $authService->login($request->username, $request->password);

        if (!$user) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->success([
            'is_admin' => $user->is_admin,
            'username' => $user->username,
        ]);
    }

    public function logout(AuthService $authService): JsonResponse
    {
        $authService->logout();

        return $this->success();
    }
}
