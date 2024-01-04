<?php

namespace App\Managers;

use App\Repositories\UserRepository;
use App\ResponseCodes\Manager\UserManagerResponse;
use App\Responses\Manager\ManagerResponse;
use Illuminate\Support\Facades\Auth;

class UserManager extends Manager
{
    /**
     * @var UserRepository
     */
    public UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(): ManagerResponse
    {

        $rtn = $this->response();
        $rtn->data['data'] = [];

        $acquireAllResponse = $this->repository->acquireAll();

        if ($acquireAllResponse->success && $acquireAllResponse->hasData) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireAllResponse->data;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;

    }

    public function store(): ManagerResponse
    {
        $rtn = $this->response();

        try {
            $firstname = request()->get('firstname');
            $lastname = request()->get('lastname');
            $email = request()->get('email');
            $password = request()->get('password');
            $attributes = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $password,
            ];

            $addResponse = $this->repository->add($attributes);

            if ($addResponse->hasData && $addResponse->success) {
                $rtn->data['data'] = $addResponse->data;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    public function update(int $id): ManagerResponse
    {
        $rtn = $this->response();
        \DB::beginTransaction();

        try {
            $firstname = request()->get('firstname');
            $lastname = request()->get('lastname');
            $email = request()->get('email');
            $password = request()->get('password');
            $attributes = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $password,
            ];
            $adjustResponse = $this->repository->NTCadjust($id, $attributes);

            if ($adjustResponse->hasData) {
                if ($adjustResponse->success) {
                    $rtn->data['data'] = $adjustResponse->data;
                    $rtn->setSuccessDefault();
                } else {
                    $rtn->setErrorDefault();
                }
            } else {
                $rtn->setError(UserManagerResponse::UPDATE_ERROR_NO_USER_FOUND);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \DB::rollBack();
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    public function login(): ManagerResponse
    {
        $rtn = $this->response();

        try {
            $email = request()->get('email');
            $password = request()->get('password');
            $attributes = [
                'email' => $email,
                'password' => $password,
            ];

            if (Auth::attempt($attributes)) {
                $user = Auth::user();
                $rtn->setSuccessDefault();
                $rtn->data['data'] = $user;
            } else {
                $rtn->setError(UserManagerResponse::LOGIN_ERROR_INVALID_CREDENTIALS);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \DB::rollBack();
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    public function logout(): ManagerResponse
    {
        $rtn = $this->response();

        try {
            Auth::logout();
            $rtn->setSuccessDefault();
        } catch (\Exception $e) {
            \DB::rollBack();
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \DB::rollBack();
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }
}
