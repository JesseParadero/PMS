<?php

namespace App\ResponseCodes\Manager;

use App\ResponseCodes\ResponseCode;

class UserManagerResponse extends ResponseCode
{
    // LOGIN
    const LOGIN_ERROR_INVALID_CREDENTIALS = 201;
    // UPDATE
    const UPDATE_ERROR_NO_USER_FOUND = 201;
}
