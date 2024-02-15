<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\CategoryRequest;
use App\Models\Settings\Category;
use App\Repositories\Settings\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return CategoryRepository::class;
    }

    public function getRequestClass(): string
    {
        return CategoryRequest::class;
    }

    public function setChannelsPositions(Category $category, Request $request)
    {
        $this->validate($request, [
            'channels' =>'required|array',
        ]);

        $channels = $request->channels;
        $data = [];
        foreach ($channels as $channel) {
            $data[$channel->id] = ['position' => $channel->pivot->position];
        }

        $category->channels()->sync($data);

        return $this->success();
    }
}
