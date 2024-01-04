<?php

namespace App\Responses\Repository;

use App\Models\Model;
use App\Responses\ResponseItem;

// use App\ResponseCodes\ResponseCode;

class RepositoryResponseItem extends ResponseItem
{
    public $data;
    public bool $success = false;
    public bool $hasData = false;

    public function __construct($model)
    {
        $this->data = $model::empty();
    }
}
