<?php

namespace App\Responses\Repository;

use App\Responses\ResponseList;
use Illuminate\Database\Eloquent\Collection;

class RepositoryResponseCollection extends ResponseList
{
    public Collection $data;
    public bool $success = false;
    public bool $hasData = false;

    public function __construct()
    {
        $this->data = Collection::make([]);
    }
}
