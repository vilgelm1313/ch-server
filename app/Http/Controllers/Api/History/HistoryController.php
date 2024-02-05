<?php

namespace App\Http\Controllers\Api\History;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\History\HistoryRepository;

class HistoryController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return HistoryRepository::class;
    }

    public function getRequestClass(): string
    {
        return '';
    }
}
