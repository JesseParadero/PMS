<?php

namespace App\ResponseCodes;

class ResponseCode
{
    private function __construct()
    {
        //
    }

    const NONE = 0;
    const SUCCESS = 100;
    const ERROR = 200;
}
