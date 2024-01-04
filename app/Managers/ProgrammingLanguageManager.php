<?php

namespace App\Managers;

use App\Repositories\ProgrammingLanguageRepository;
use App\Responses\Manager\ManagerResponse;

class ProgrammingLanguageManager extends Manager
{
    /**
     * @var ProgrammingLanguageRepository
     */
    public ProgrammingLanguageRepository $repository;

    public function __construct(ProgrammingLanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(): ManagerResponse
    {
        $rtn = $this->response();
        $rtn->data['data'] = [];

        $acquireAllResponse = $this->repository->acquireAllReturnPagination();

        if ($acquireAllResponse->success) {
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
            $language_name = request()->get('language_name');
            $attributes = [
                'language_name' => $language_name
            ];
            $addResponse = $this->repository->NTCadd($attributes);

            if ($addResponse->success && $addResponse->hasData) {
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

    public function destroy(int $id): ManagerResponse
    {
        $rtn = $this->response();

        try {
            $annulResponse = $this->repository->NTCannul($id);

            if ($annulResponse->hasData && $annulResponse->success) {
                $rtn->data['data'] = $annulResponse->data;
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

        try {
            $language_name = request()->get('language_name');
            $attributes = [
                'language_name' => $language_name
            ];
            $adjustResponse = $this->repository->NTCadjust($id, $attributes);

            if ($adjustResponse->hasData && $adjustResponse->success) {
                $rtn->data['data'] = $adjustResponse->data;
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
}
