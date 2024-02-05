<?php

namespace Tests\Unit\Repository;

use App\Models\Settings\Category;
use App\Repositories\Settings\CategoryRepository;

class CategoryRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = CategoryRepository::class;
    protected string $modelClass = Category::class;

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'parent' => null,
            'is_active' => false,
            'index' => 1,
        ];
    }
}
