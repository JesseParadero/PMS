<?php

namespace App\Http\Controllers;

use App\Managers\EvaluationManager;
use App\Models\ProgrammingLanguage;
use App\Models\User;


class EvaluationController extends Controller
{
    protected EvaluationManager $manager;

    public function __construct(EvaluationManager $manager)
    {
        $this->manager = $manager;
    }

    public function show(User $user)
    {
        return view('pages.auth.dashboard.evaluate', compact('user'));
    }

    public function getProgrammingLanguages()
    {
        $rtn = null;
        $managerResponse = $this->manager->getProgrammingLanguages();

        if ($managerResponse->isSuccess()) {
            $rtn = response()->json($managerResponse->data['data']);
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = response()->json(['error' => __('messages.default.failed.read', ['name' => __('words.Evaluation')])]);
        } else {
            $rtn = response()->json(['error' => __('messages.default.request.invalid')]);
        }

        return $rtn;
    }

    public function getData(int $id)
    {
        $rtn = null;
        $managerResponse = $this->manager->getData($id);

        if ($managerResponse->isSuccess()) {
            $rtn = response()->json($managerResponse->data['data']);
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = response()->json(['error' => __('messages.default.failed.read', ['name' => __('words.Evaluation')])]);
        } else {
            $rtn = response()->json(['error' => __('messages.default.request.invalid')]);
        }

        return $rtn;
    }

    public function getRatings()
    {
        $rtn = null;
        $getRatingsResponse = $this->manager->getRatings();
        $getCriteriaResponse = $this->manager->getCriteria();

        if ($getRatingsResponse->isSuccess() && $getCriteriaResponse->isSuccess()) {
            $response = [
                'ratings' => $getRatingsResponse->data['data'],
                'criteria' => $getCriteriaResponse->data['data'],
            ];
            $rtn = response()->json($response);
        } elseif ($getRatingsResponse->isErrorDefault()) {
            $rtn = response()->json(['error' => __('messages.default.failed.read', ['name' => __('words.Evaluation')])]);
        } else {
            $rtn = response()->json(['error' => __('messages.default.request.invalid')]);
        }

        return $rtn;
    }
}
