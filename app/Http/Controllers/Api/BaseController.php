<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseController extends ApiController
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'per_page' => 'nullable|in:10,25,50,100',
        ]);

        $models = $this->getRepository()->index($request->per_page, $request->all());

        return $this->success($models);
    }

    public function show(int $id): JsonResponse
    {
        $model = $this->getRepository()->show($id);

        return $this->success($model);
    }

    public function store(): JsonResponse
    {
        $request = app()->make($this->getRequestClass());
        $model = $this->getRepository()->store($request->all());

        return $this->success($model);
    }

    public function update(int $id): JsonResponse
    {
        $request = app()->make($this->getRequestClass());
        $model = $this->getRepository()->update($id, $request->all());

        return $this->success($model);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->getRepository()->destroy($id);

        return $this->success();
    }

    public function activate(int $id): JsonResponse
    {
        $this->getRepository()->activate($id);

        return $this->success();
    }

    public function deactivate(int $id): JsonResponse
    {
        $this->getRepository()->deactivate($id);

        return $this->success();
    }

    protected function getRepository(): BaseRepository
    {
        /**
         * @var BaseRepository
         */
        return app()->make($this->getRepositoryClass());
    }

    abstract protected function getRepositoryClass(): string;

    abstract protected function getRequestClass(): string;
}
