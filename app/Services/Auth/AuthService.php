<?php

namespace App\Services\Auth;

use App\Events\Auth\AuthEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    public function login(string $username, string $password): bool
    {

        if ($this->isBanned()) {
            AuthEvent::dispatch('attempt', 'banned ' . $username);

            return false;
        } else {
            AuthEvent::dispatch('attempt', $username);
        }
        $success = Auth::attempt([
            'username' => $username,
            'password' => $password,
        ], true);

        if (!$success) {
            return false;
        }

        $user = Auth::user();

        if (!$user->is_active) {
            return false;
        }

        AuthEvent::dispatch('login');

        return true;
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

        return true;
    }
}
