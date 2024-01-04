<?php

namespace App\Managers;

use App\Models\ProfessionalDevelopment;
use App\Models\ProfessionalRating;
use App\Models\ProgrammingLanguage;
use App\Responses\Manager\ManagerResponse;

class EvaluationManager extends Manager
{
    public function getProgrammingLanguages(): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = ProgrammingLanguage::all();

        if ($acquireAllResponse) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireAllResponse;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }

    public function getRatings(): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = ProfessionalRating::orderBy('score', 'desc')->get();

        if ($acquireAllResponse) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireAllResponse;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }

    public function getCriteria(): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = ProfessionalDevelopment::all();

        if ($acquireAllResponse) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireAllResponse;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }

    public function getData(int $id): ManagerResponse
    {
        $rtn = $this->response();
        $acquireAllResponse = ProgrammingLanguage::with('levels.criterias.subCriterias')->find($id);

        if ($acquireAllResponse) {
            $rtn->setSuccessDefault();
            $rtn->data['data'] = $acquireAllResponse;
        } else {
            $rtn->setErrorDefault();
        }

        return $rtn;
    }
}
