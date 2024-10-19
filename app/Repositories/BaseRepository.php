<?php

namespace App\Repositories;

use App\Events\Model\ModelDestroyed;
use App\Events\Model\ModelStored;
use App\Events\Model\ModelUpdated;
use App\Models\BaseModel;
use App\Services\Filter\FilterService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    public function show(int $id): BaseModel
    {
        $model = $this->getQuery()
            ->with($this->getWith())
            ->findOrFail($id);

        return $model;
    }

    public function all()
    {
        return $this->getQuery()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function index(?int $perPage = 100, ?array $filters = []): LengthAwarePaginator
    {
        $builder = $this->getQuery();
        return $this->paginate($builder, $perPage, $filters);
    }

    protected function paginate(Builder $builder, ?int $perPage = 100, ?array $filters = []): LengthAwarePaginator
    {
        /**
         * @var FilterService
         */
        $filterService = app()->make(FilterService::class);
        /**
         * @var Builder
         */
        $builder = $filterService->addFilters($builder, $this->getClass(), $filters);
        if (isset($filters['sort']) && isset( $filters['order']) && in_array($filters['sort'], $this->getClass()::SORT_FIELDS)) {
            $builder->orderBy($filters['sort'], $filters['order'] === 'descend' ? 'desc' : 'asc');
        } else if ($this->getDefaultOrderColumn()) {
            $builder->orderBy($this->getDefaultOrderColumn(), $this->getDefaultOrderDirection());
        }
        $with = $this->getWith();
        if (count($with)) {
            $builder->with($with);
        }

        return $builder->paginate($perPage ?? 100);
    }

    public function store(array $data): BaseModel
    {
        $model = $this->getQuery()->create($data);
        $model = $this->afterSave($model, $data);

        ModelStored::dispatch($model);

        return $model;
    }

    public function update(int $id, array $data): BaseModel
    {
        $model = $this->show($id);

        $oldValues = $model->toArray();
        $model->fill($data);
        $model->save();

        $model = $this->afterSave($model, $data);
        ModelUpdated::dispatch($model, $oldValues);

        return $model;
    }

    public function activate(int $id): BaseModel
    {
        return $this->update($id, ['is_active' => true]);
    }

    public function deactivate(int $id): BaseModel
    {
        return $this->update($id, ['is_active' => false]);
    }

    public function destroy(int $id): bool
    {
        $model = $this->show($id);
        $deleted = $model->delete();

        if ($deleted) {
            ModelDestroyed::dispatch($model);
        }

        return $deleted;
    }

    protected function getQuery(): Builder
    {
        return $this->getClass()::query();
    }

    protected function getWith(): array
    {
        return [];
    }

    protected function getDefaultOrderColumn(): string
    {
        return '';
    }

    protected function getDefaultOrderDirection(): string
    {
        return 'asc';
    }

    protected function afterSave(BaseModel $model, array $data): BaseModel
    {
        return $model;
    }

    abstract protected function getClass(): string;
}
