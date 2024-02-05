<?php

namespace Database\Seeders;

use App\Models\Settings\Category;

class CategoriesSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $c = Category::find($item['id']);
        if (!$c) {
            $c = new Category();
            $c->id = $item['id'];
        }
        $c->name = $item['name'];
        $c->index = $item['order'];
        if ($item['parent'] && $item['parent'] != 0) {
            $c->is_parental_control = true;
        } else {
            $c->is_parental_control = false;
        }
        $c->save();
    }

    public function getFileName(): string
    {
        return 'categories';
    }
}
