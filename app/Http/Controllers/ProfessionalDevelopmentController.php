<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfessionalDevelopmentRequest;
use App\Managers\ProfessionalDevelopmentManager;
use App\Models\ProfessionalDevelopment;
use App\ResponseCodes\Manager\ProfessionalDevelopmentManagerResponse;

class ProfessionalDevelopmentController extends Controller
{
    protected ProfessionalDevelopmentManager $manager;

    public function __construct(ProfessionalDevelopmentManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $managerResponse = $this->manager->all();
        return view('pages.auth.dashboard.criteria', $managerResponse->data);
    }

    public function store(ProfessionalDevelopmentRequest $request)
    {
        $managerResponse = $this->manager->store();
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('development.index')
                ->with('success', __('messages.default.success.create', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.create', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function update(ProfessionalDevelopmentRequest $request, ProfessionalDevelopment $development)
    {
        $managerResponse = $this->manager->update($development->id);
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('development.index')
                ->with('success', __('messages.default.success.update', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } elseif ($managerResponse->is(ProfessionalDevelopmentManagerResponse::UPDATE_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.notFound', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.update', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function destroy(ProfessionalDevelopment $development)
    {
        $managerResponse = $this->manager->destroy($development->id);
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('development.index')
                ->with('success', __('messages.default.success.delete', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } elseif ($managerResponse->is(ProfessionalDevelopmentManagerResponse::DESTROY_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.notFound', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.delete', ['name' => __('words.ProfessionalDevelopmentCriteria')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }
}
