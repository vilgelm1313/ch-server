<?php

namespace Tests\Unit\Services;

use App\Events\Auth\AuthEvent;
use App\Models\User\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    protected AuthService $authService;
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->authService = app()->make(AuthService::class);
        $this->user = User::factory()->create([
            'password' => 'pass',
        ]);
        $this->actingAs($this->user);
        Event::fake();
    }

    public function testFailLogin()
    {
        $success = $this->authService->login($this->user->username, 'badpass');
        $this->assertFalse($success);
        Event::assertDispatched(AuthEvent::class, function (AuthEvent $event) {
            return $event->action === 'attempt';
        });
    }

    public function testSuccessLogin()
    {
        $success = $this->authService->login($this->user->username, 'pass');
        $this->assertTrue($success);
        Event::assertDispatched(AuthEvent::class, function (AuthEvent $event) {
            return $event->action === 'login';
        });
    }

    public function testFailLoginInactiveUser()
    {
        $this->user->is_active = false;
        $this->user->save();
        $success = $this->authService->login($this->user->username, 'pass');
        $this->assertFalse($success);

        Event::assertDispatched(AuthEvent::class, function (AuthEvent $event) {
            return $event->action === 'attempt';
        });
    }
}
