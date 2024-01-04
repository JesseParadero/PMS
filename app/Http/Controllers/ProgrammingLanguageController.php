<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\ProgrammingLanguage;
use App\Managers\ProgrammingLanguageManager;

class ProgrammingLanguageController extends Controller
{
    protected ProgrammingLanguageManager $manager;

    public function __construct(ProgrammingLanguageManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $managerResponse = $this->manager->all();
        return view('pages.auth.dashboard.language', $managerResponse->data);
    }

    public function store(StorePostRequest $request)
    {
        $rtn = null;
        $managerResponse = $this->manager->store();

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('language.index')
                ->with('success', __('messages.default.success.create'));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.create', ['name' => __('words.User')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function edit(ProgrammingLanguage $project)
    {
        return view('pages.auth.dashboard.update', compact('project'));
    }

    public function editLevel(ProgrammingLanguage $project)
    {
        session()->flash('activeTab', 'level');
        session()->flash('Tab', 'update');
        return view('pages.auth.project.update', compact('project'));
    }

    public function update(StorePostRequest $request, ProgrammingLanguage $project)
    {
        $rtn = null;
        $managerResponse = $this->manager->update($project->id);

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('language.index')
                ->with('success', __('messages.default.success.create'));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.update', ['name' => __('words.User')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function destroy(ProgrammingLanguage $project)
    {
        $managerResponse = $this->manager->destroy($project->id);

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('language.index')
                ->with('success', __('messages.default.success.delete', ['name' => __('words.User')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.delete', ['name' => __('words.User')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }
}
