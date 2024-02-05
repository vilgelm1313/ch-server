<?php

namespace Tests\Feature\User;

use App\Models\User\User;
use Tests\Feature\BaseController;

class UserControllerTest extends BaseController
{
    protected string $model = User::class;
    protected string $apiPath = 'user';

    protected function getFields(): array
    {
        return [
            'username' => 'test',
            'password' => '<PASSWORD>',
            'password_confirmation' => '<PASSWORD>',
            'is_active' => true,
        ];
    }

    public function testUpdateWithoutPassword()
    {
        $model = $this->model::factory()->create();
        $params = $this->getFields();

        unset($params['password']);
        unset($params['password_confirmation']);

        $this->putJson('/user/' . $model->id, $params)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $params,
            ]);

        $checkFields = array_merge($params, ['id' => $model->id]);
        $this->assertDatabaseHas($model->getTable(), $checkFields);
    }

    //TODO test login after change password
}
