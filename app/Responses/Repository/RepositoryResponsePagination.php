<?php

namespace App\Responses\Repository;

use App\Responses\ResponseList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class RepositoryResponsePagination extends ResponseList
{
    public LengthAwarePaginator $data;
    public bool $success = false;
    public bool $hasData = false;

    public function __construct()
    {
        $this->data = $this->arrayToPagination([]);
    }

    public function arrayToPagination(array $items, int $perPage = 5, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
