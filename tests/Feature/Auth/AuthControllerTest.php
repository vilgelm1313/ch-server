<?php

namespace Tests\Feature\Auth;

use App\Models\User\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'password' => 'pass',
        ]);
    }

    public function testLogin()
    {
        $this->json('POST', '/auth/login', ['username' => $this->user->username, 'password' => 'pass'])
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testFailLogin()
    {
        $this->json('POST', '/auth/login', ['username' => $this->user->username, 'password' => 'bad'])
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
            ]);
    }

    public function testLogout()
    {
        $this->actingAs($this->user);
        $this->json('POST', '/auth/logout')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
