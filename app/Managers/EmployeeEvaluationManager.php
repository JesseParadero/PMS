<?php

namespace App\Managers;

use App\Models\EmployeeEvaluation;
use App\ResponseCodes\Manager\EmployeeEvaluationManagerResponse;
use App\Responses\Manager\ManagerResponse;

class EmployeeEvaluationManager extends Manager
{
    public function all(): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = EmployeeEvaluation::paginate(7);

        if ($acquireAllResponse) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireAllResponse;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }

    public function store(): ManagerResponse
    {
        $rtn = $this->response();
        $attributes = [
            'employee_id' => request()->get('employee_id'),
            'programming_id' => request()->get('programming_id'),
            'programming_type' => request()->get('programming_type'),
            'evaluation_date' => now(),
            'total_score' => request()->get('total_score'),
        ];

        $addResponse = EmployeeEvaluation::create($attributes);

        if ($addResponse) {
            $rtn->data['data'] = $addResponse;
            $rtn->setSuccessDefault();
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }

    public function update(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $evaluation = EmployeeEvaluation::find($id);

        if ($evaluation) {
            $attributes = [
                'employee_id' => request()->get('employee_id'),
                'programming_id' => request()->get('programming_id'),
                'programming_type' => request()->get('programming_type'),
                'evaluation_date' => now(),
                'total_score' => request()->get('total_score'),
            ];

            if ($evaluation->update($attributes)) {
                $rtn->data['data'] = $evaluation;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } else {
            $rtn->setError(EmployeeEvaluationManagerResponse::UPDATE_ERROR_NO_USER_FOUND);
        }

        return $rtn;
    }
    public function destroy(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $evaluation = EmployeeEvaluation::find($id);

        if ($evaluation) {
            $deleteResponse = EmployeeEvaluation::destroy($id);

            if ($deleteResponse) {
                $rtn->data['data'] = $deleteResponse;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } else {
            $rtn->setError(EmployeeEvaluationManagerResponse::DESTROY_ERROR_NO_USER_FOUND);
        }


        return $rtn;
    }
}
