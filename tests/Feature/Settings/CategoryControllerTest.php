<?php

namespace Tests\Feature\Settings;

use App\Models\Settings\Category;
use Tests\Feature\BaseController;

class CategoryControllerTest extends BaseController
{
    protected string $model = Category::class;
    protected string $apiPath = 'category';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => false,
            'index' => 1,
        ];
    }

    public function testStoreWithExistingName()
    {
        $category = Category::factory()->create();
        $this->postJson('/category', $category->toArray())
            ->assertJson([
                'success' => false,
            ]);
    }
}
