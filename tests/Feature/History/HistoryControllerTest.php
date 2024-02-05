<?php

namespace Tests\Feature\History;

use App\Models\History\History;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function testIndex()
    {
        History::factory()->count(10)->create();

        $this->getJson('history')
            ->assertStatus(200)
            ->assertJsonCount(10, 'data.data');
    }
}
