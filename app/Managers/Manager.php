<?php

namespace App\Managers;

use App\Repositories\Repository;
use App\Responses\Manager\ManagerResponse;

class Manager
{
    /**
     * @var Repository
     */
    // public $repository;

    public function response(): ManagerResponse
    {
        return new ManagerResponse();
    }
}
