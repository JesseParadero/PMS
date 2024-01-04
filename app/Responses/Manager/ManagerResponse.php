<?php

namespace App\Responses\Manager;

use App\ResponseCodes\ResponseCode;
use App\Responses\ResponseList;

class ManagerResponse extends ResponseList
{
    public array $data = [];
    public bool $success = false;
    public int $responseCode;
    public string $message = '';

    public array $responseCheckList = [
        'data',
        'success'
    ];

    public function __construct()
    {
        $this->responseCode = ResponseCode::NONE;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function isError(): bool
    {
        return $this->success === false;
    }

    public function isSuccessDefault(): bool
    {
        return $this->responseCode == ResponseCode::SUCCESS;
    }

    public function isErrorDefault(): bool
    {
        return $this->responseCode == ResponseCode::ERROR;
    }

    public function is(int $responseCode): bool
    {
        return $this->responseCode == $responseCode;
    }

    public function setSuccessDefault(): void
    {
        $this->success = true;
        $this->responseCode = ResponseCode::SUCCESS;
    }

    public function setSuccess(int $responseCode): void
    {
        $this->success = true;
        $this->responseCode = $responseCode;
    }

    public function setErrorDefault(): void
    {
        $this->success = false;
        $this->responseCode = ResponseCode::ERROR;
    }

    public function setError(int $responseCode): void
    {
        $this->success = false;
        $this->responseCode = $responseCode;
    }
}
