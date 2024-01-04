<?php

namespace App\Managers;

use App\Models\ProfessionalRating;
use App\ResponseCodes\Manager\ProfessionalRatingManagerResponse;
use App\Responses\Manager\ManagerResponse;

class ProfessionalRatingManager extends Manager
{
    public function all(): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = ProfessionalRating::orderBy('score', 'desc')->paginate(7);

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
            'description' => request()->get('description'),
            'score' => request()->get('score'),
        ];
        $addResponse = ProfessionalRating::create($attributes);

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
        $rating = ProfessionalRating::find($id);

        if ($rating) {
            $attributes = [
                'description' => request()->get('description'),
                'score' => request()->get('score'),
            ];

            if ($rating->update($attributes)) {
                $rtn->data['data'] = $rating;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } else {
            $rtn->setError(ProfessionalRatingManagerResponse::UPDATE_ERROR_NO_USER_FOUND);
        }

        return $rtn;
    }
    public function destroy(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $rating = ProfessionalRating::find($id);

        if ($rating) {
            $deleteResponse = ProfessionalRating::destroy($id);

            if ($deleteResponse) {
                $rtn->data['data'] = $deleteResponse;
                $rtn->setSuccessDefault();
            } else {
                $rtn->setErrorDefault();
            }
        } else {
            $rtn->setError(ProfessionalRatingManagerResponse::DESTROY_ERROR_NO_USER_FOUND);
        }


        return $rtn;
    }
}
