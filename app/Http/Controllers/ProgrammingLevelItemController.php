<?php

namespace App\Http\Controllers;

use App\Managers\ProgrammingLevelItemManager;

class ProgrammingLevelItemController extends Controller
{
    protected ProgrammingLevelItemManager $manager;

    public function __construct(ProgrammingLevelItemManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $managerResponse = $this->manager->all();
        return view('pages.auth.project.update', compact('managerResponse'));
    }

    public function storeOrUpdate($id)
    {
        $rtn = null;
        $managerResponse = $this->manager->storeOrUpdate($id);

        if ($managerResponse->isSuccess()) {
            return redirect()
                ->back()
                ->with('success', __('messages.default.success.create'))
                ->with('activeTab', 'level')
                ->with('Tab', 'update');
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.create', ['name' => __('words.User')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid1'));
        }

        return $rtn;
    }

    public function destroy($id)
    {
        $managerResponse = $this->manager->destroy($id);
        session()->flash('activeTab', 'level');
        session()->flash('Tab', 'update');

        if ($managerResponse->isSuccess()) {
            session()->flash('success', __('messages.default.success.delete'));
            $rtn = response()->json(['success' => true]);
        } elseif ($managerResponse->isErrorDefault()) {
            session()->flash('error', __('messages.default.failed.delete'));
            $rtn = response()->json(['error' => true]);
        } else {
            session()->flash('error', __('messages.default.request.invalid'));
            $rtn = response()->json(['error' => true]);
        }

        return $rtn;
    }

    public function show($id)
    {
        $rtn = null;
        $managerResponse = $this->manager->get($id);
        session()->flash('activeTab', 'level');
        session()->flash('Tab', 'update');

        if ($managerResponse->isSuccess()) {
            $rtn = response()->json($managerResponse->data['data']);
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = response()->json(['error' => __('messages.default.failed.read', ['name' => __('words.ProgrammingLevelItemCriteria')])]);
        } else {
            $rtn = response()->json(['error' => __('messages.default.request.invalid')]);
        }
        return $rtn;
    }
}
