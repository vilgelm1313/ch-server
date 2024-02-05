<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('username', env('ADMIN_USERNAME', 'admin'))->first();
        if (!$user) {
            $user = new User();
        }
        $user->username = env('ADMIN_USERNAME', 'admin');
        $user->password = env('ADMIN_PASSWORD', 'password');
        $user->is_active = true;
        $user->save();
    }
}
