<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfessionalRatingRequest;
use App\Managers\ProfessionalRatingManager;
use App\Models\ProfessionalRating;
use App\ResponseCodes\Manager\ProfessionalRatingManagerResponse;

class ProfessionalRatingController extends Controller
{
    protected ProfessionalRatingManager $manager;

    public function __construct(ProfessionalRatingManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $managerResponse = $this->manager->all();
        return view('pages.auth.dashboard.rating', $managerResponse->data);
    }

    public function store(ProfessionalRatingRequest $request)
    {
        $managerResponse = $this->manager->store();
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('rating.index')
                ->with('success', __('messages.default.success.create', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.create', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function update(ProfessionalRatingRequest $request, ProfessionalRating $rating)
    {
        $managerResponse = $this->manager->update($rating->id);
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('rating.index')
                ->with('success', __('messages.default.success.update', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } elseif ($managerResponse->is(ProfessionalRatingManagerResponse::UPDATE_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.notFound', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.update', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function destroy(ProfessionalRating $rating)
    {
        $managerResponse = $this->manager->destroy($rating->id);
        $rtn = null;

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('rating.index')
                ->with('success', __('messages.default.success.delete', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } elseif ($managerResponse->is(ProfessionalRatingManagerResponse::DESTROY_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.notFound', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.delete', ['name' => __('words.ProfessionalDevelopmentRating')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }
}
