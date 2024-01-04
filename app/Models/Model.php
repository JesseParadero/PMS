<?php

namespace App\Models;

use App\Traits\Model\ModelTrait;
use Illuminate\Database\Eloquent\Model as Md;

class Model extends Md
{
    use ModelTrait;

    /**
     * @var $appends
     */
    protected $appends = [
        'id',
        'is_empty',
        'is_not_empty',
    ];
}
