<?php

namespace App\Services\Auth;

use App\Events\Auth\AuthEvent;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    public function login(string $username, string $password): ?User
    {

        if ($this->isBanned()) {
            AuthEvent::dispatch('attempt', 'banned ' . $username);
            return null;
        } else {
            AuthEvent::dispatch('attempt', $username);
        }
        $success = Auth::attempt([
            'username' => $username,
            'password' => $password,
        ], true);

        if (!$success) {
            return null;
        }

        $user = Auth::user();

        if (!$user->is_active) {
            return null;
        }

        AuthEvent::dispatch('login');

        return $user;
    }

    public function logout()
    {
        AuthEvent::dispatch('logout');
        auth('web')->logout();
    }

    protected function isBanned(): bool
    {
        $key = 'auth_attempts_' . request()->ip();
        $attempts = Cache::get($key, 0);
        if ($attempts < 3) {
            Cache::set($key, $attempts + 1, now()->addMinutes(15));

            return false;
        }

        return false;
    }
}
