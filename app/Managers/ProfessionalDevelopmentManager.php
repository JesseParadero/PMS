<?php

namespace App\Managers;

use App\Models\ProfessionalDevelopment;
use App\ResponseCodes\Manager\ProfessionalDevelopmentManagerResponse;
use App\Responses\Manager\ManagerResponse;

class ProfessionalDevelopmentManager extends Manager
{
    public function all(): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = ProfessionalDevelopment::paginate(7);

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
            'criteria_description' => request()->get('description'),
        ];
        $addResponse = ProfessionalDevelopment::create($attributes);

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
        $rating = ProfessionalDevelopment::find($id);

        if ($rating) {
            $attributes = [
                'criteria_description' => request()->get('description'),
            ];

            if ($rating->update($attributes)) {
                $rtn->data['data'] = $rating;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } else {
            $rtn->setError(ProfessionalDevelopmentManagerResponse::UPDATE_ERROR_NO_USER_FOUND);
        }

        return $rtn;
    }
    public function destroy(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $rating = ProfessionalDevelopment::find($id);

        if ($rating) {
            $deleteResponse = ProfessionalDevelopment::destroy($id);

            if ($deleteResponse) {
                $rtn->data['data'] = $deleteResponse;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } else {
            $rtn->setError(ProfessionalDevelopmentManagerResponse::DESTROY_ERROR_NO_USER_FOUND);
        }


        return $rtn;
    }
}
