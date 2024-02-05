<?php

namespace App\Services\Filter;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    public function addFilters(Builder $builder, string $model, array $params = []): Builder
    {
        $filters = $this->getAvailableFilters($model);

        foreach ($filters as $key => $filter) {
            if (empty($params[$key])) {
                continue;
            }
            if (empty($filter['field'])) {
                $filter['field'] = $key;
            }
            $builder = $this->addFilter($builder, $filter, $params[$key]);
        }

        return $builder;
    }

    public function addFilter(Builder $builder, array $filter, mixed $value): Builder
    {
        if ($value === null) {
            return $builder;
        }
        if ($filter['type'] === 'equal') {
            $builder->where($filter['field'], $value);
        } elseif ($filter['type'] === 'string') {
            if (isset($filter['relationship'])) {
                $builder->whereHas($filter['relationship'], function (Builder $query) use ($filter, $value) {
                    $query->where($filter['field'], 'like', '%' . $value . '%');
                });
            } else {
                $builder->where($filter['field'], 'like', '%' . $value . '%');
            }
        } elseif ($filter['type'] === 'list') {
            if (!is_array($value)) {
                $value = [$value];
            }
            $in = [];
            $notIn = [];

            foreach ($value as $item) {
                if ($item < 0) {
                    $notIn[] = abs($item);
                } else {
                    $in[] = $item;
                }
            }

            if (count($in)) {
                $builder->whereIn($filter['field'], $in);
            }

            if (count($notIn)) {
                $builder->whereNotIn($filter['field'], $notIn);
            }
        }

        return $builder;
    }

    protected function getAvailableFilters(string $model): array
    {
        $filters = [];
        if (defined($model . '::FILTERS')) {
            $filters = $model::FILTERS;
        } else {
            $filters = [];
        }
        $filters['id'] = [
            'field' => 'id',
            'type' => 'list',
        ];

        return $filters;
    }
}
