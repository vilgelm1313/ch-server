<?php

namespace Tests\Feature;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseController extends TestCase
{
    use RefreshDatabase;

    protected string $model;
    private string $path;
    protected string $apiPath;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->path = $this->apiPath;
    }

    public function testIndex()
    {
        $this->model::factory()->count(10)->create();

        $count = $this->model::count();

        $this->getJson($this->path)
            ->assertStatus(200)
            ->assertJsonCount($count, 'data.data');
    }

    public function testStore()
    {
        $params = $this->getFields();
        $checkFields = $params;

        if (isset($params['password'])) {
            unset($checkFields['password']);
            unset($checkFields['password_confirmation']);
        }

        $this->postJson($this->path, $params)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $checkFields,
            ]);
    }

    public function testShow()
    {
        $model = $this->model::factory()->create();
        $this->getJson($this->path . '/' . $model->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $model->toArray(),
            ]);
    }

    public function testUpdate()
    {
        $model = $this->model::factory()->create();
        $params = $this->getFields();
        $checkFields = $params;

        if (isset($params['password'])) {
            unset($checkFields['password']);
            unset($checkFields['password_confirmation']);
        }
        $this->putJson($this->path . '/' . $model->id, $params)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $checkFields,
            ]);

        $checkFields = array_merge($checkFields, ['id' => $model->id]);
        $this->assertDatabaseHas($model->getTable(), $checkFields);
    }

    public function testDestroy()
    {
        $model = $this->model::factory()->create();
        $this->deleteJson($this->path . '/' . $model->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => null,
            ]);

        $this->assertDatabaseMissing($model->getTable(), [
            'id' => $model->id,
        ]);
    }

    abstract protected function getFields(): array;
}
