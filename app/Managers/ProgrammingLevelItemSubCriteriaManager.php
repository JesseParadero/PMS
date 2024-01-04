<?php

namespace App\Managers;

use App\Repositories\ProgrammingLevelItemCriteriaRepository;
use App\Repositories\ProgrammingLevelItemSubCriteriaRepository;
use App\ResponseCodes\Manager\ProgrammingLevelItemCriteriaManagerResponse;
use App\Responses\Manager\ManagerResponse;

class ProgrammingLevelItemSubCriteriaManager extends Manager
{
    /**
     * @var ProgrammingLevelItemSubCriteriaRepository
     */
    public ProgrammingLevelItemSubCriteriaRepository $repository;

    public function __construct(ProgrammingLevelItemSubCriteriaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $rtn->data['data'] = null;

        $acquireResponse = $this->repository->acquireAll([
            'programming_level_item_criteria_id' => $id
        ]);

        if ($acquireResponse->success) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireResponse->data;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }

    public function storeOrUpdate(): ManagerResponse
    {
        $rtn = $this->response();

        try {
            $programming_level_item_criteria_id = request()->get('programming_level_item_criteria_id');
            $criteria_descriptions = request()->get('criteria_description');
            $sub_criteria_id = request()->get('sub_criteria_id');

            foreach ($criteria_descriptions as $index => $criteria_description) {
                $attributes = [
                    'programming_level_item_criteria_id' => $programming_level_item_criteria_id,
                    'criteria_description' => $criteria_description
                ];

                if (request()->has('sub_criteria_id.' . $index)) {
                    $adjustResponse = $this->repository->NTCadjust($sub_criteria_id[$index], $attributes);

                    if ($adjustResponse->hasData && $adjustResponse->success) {
                        $rtn->data['data'] = $adjustResponse->data;
                        $rtn->setSuccessDefault();
                    } else {
                        $rtn->setErrorDefault();
                    }
                } else {
                    $addResponse = $this->repository->NTCadd($attributes);

                    if ($addResponse->success) {
                        $rtn->setSuccessDefault();
                        $rtn->data['data'] = $addResponse->data;
                    } else {
                        $rtn->setErrorDefault();
                    }
                }
            }
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    public function destroy($id): ManagerResponse
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
}
