<?php

namespace App\Managers;

use App\Models\ProgrammingLevelItem;
use App\Repositories\ProgrammingLevelItemRepository;
use App\Responses\Manager\ManagerResponse;
use App\Models\ProgrammingLanguage;

class ProgrammingLevelItemManager extends Manager
{
    /**
     * @var ProgrammingLevelItemRepository
     */
    public ProgrammingLevelItemRepository $repository;

    public function __construct(ProgrammingLevelItemRepository $repository)
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

    public function storeOrUpdate($id): ManagerResponse
    {

        $rtn = $this->response();

        try {
            $programmingLanguage = ProgrammingLanguage::find($id);
            $language_type = request()->get('language_type');
            $item_names = request()->get('item_name');
            $rank_numbers = request()->get('rank_number');
            $total_scores = request()->get('total_score');
            $level_id = request()->get('level_id');

            $defaultAttributes = [
                'language_id' => $programmingLanguage ? $programmingLanguage->id : 1,
                // 1 is static or temporary, for framework_id;
                'language_type' => $language_type,
            ];

            foreach ($item_names as $item => $item_name) {
                $rank_number = $rank_numbers[$item];
                $total_score = $total_scores[$item];
                $attributes = [
                    'item_name' => $item_name,
                    'rank_number' => $rank_number,
                    'total_score' => $total_score
                ];
                $resultAttributes = array_merge($defaultAttributes, $attributes);

                if (request()->has('level_id.' . $item)) {
                    $adjustResponse = $this->repository->NTCadjust($level_id[$item], $resultAttributes);

                    if ($adjustResponse->hasData && $adjustResponse->success) {
                        $rtn->data['data'] = $adjustResponse->data;
                        $rtn->setSuccessDefault();
                    } else {
                        $rtn->setErrorDefault();
                    }
                } else {
                    $addResponse = $this->repository->NTCadd($resultAttributes);

                    if ($addResponse->success) {
                        $rtn->data['data'] = $addResponse->data;
                        $rtn->setSuccessDefault();
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

    public function get(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $rtn->data['data'] = null;

        $acquireResponse = $this->repository->acquireAll([
            'language_id' => $id
        ]);

        if ($acquireResponse->success) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireResponse->data;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }
}
