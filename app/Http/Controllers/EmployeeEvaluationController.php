<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeEvaluationRequest;
use App\Managers\EmployeeEvaluationManager;
use App\Models\EmployeeEvaluation;
use App\ResponseCodes\Manager\EmployeeEvaluationManagerResponse;

class EmployeeEvaluationController extends Controller
{
    protected EmployeeEvaluationManager $manager;

    public function __construct(EmployeeEvaluationManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $managerResponse = $this->manager->all();
        return view('pages.auth.dashboard.record', $managerResponse->data);
    }

    public function store(EmployeeEvaluationRequest $request)
    {
        $managerResponse = $this->manager->store();
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('evaluation.index')
                ->with('success', __('messages.default.success.create', ['name' => __('words.EmployeeEvaluation')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.create', ['name' => __('words.EmployeeEvaluation')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function update(EmployeeEvaluationRequest $request, EmployeeEvaluation $evaluation)
    {
        $managerResponse = $this->manager->update($evaluation->id);
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('evaluation.index')
                ->with('success', __('messages.default.success.update', ['name' => __('words.EmployeeEvaluation')]));
        } elseif ($managerResponse->is(EmployeeEvaluationManagerResponse::UPDATE_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.notFound', ['name' => __('words.EmployeeEvaluation')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.update', ['name' => __('words.EmployeeEvaluation')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function destroy(EmployeeEvaluation $evaluation)
    {
        $managerResponse = $this->manager->destroy($evaluation->id);
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('evaluation.index')
                ->with('success', __('messages.default.success.delete', ['name' => __('words.EmployeeEvaluation')]));
        } elseif ($managerResponse->is(EmployeeEvaluationManagerResponse::DESTROY_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.notFound', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.delete', ['name' => __('words.EmployeeEvaluation')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }
}
