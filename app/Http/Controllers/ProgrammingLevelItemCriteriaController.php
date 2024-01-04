<?php

namespace App\Http\Controllers;

use App\Managers\ProgrammingLevelItemCriteriaManager;

class ProgrammingLevelItemCriteriaController extends Controller
{
    protected ProgrammingLevelItemCriteriaManager $manager;

    public function __construct(ProgrammingLevelItemCriteriaManager $manager)
    {
        $this->manager = $manager;
    }

    public function storeOrUpdate()
    {
        $rtn = null;
        $managerResponse = $this->manager->storeOrUpdate();

        if ($managerResponse->isSuccess()) {
            return redirect()
                ->back()
                ->with('success', __('messages.default.success.create', ['name' => __('words.ProgrammingLevelItemCriteria')]))
                ->with('activeTab', 'criteria')
                ->with('Tab', 'update');
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.failed.create', ['name' => __('words.ProgrammingLevelItemCriteria')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }

    public function show(int $id)
    {
        $rtn = null;
        $managerResponse = $this->manager->get($id);
        session()->flash('activeTab', 'criteria');
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

    public function destroy($id)
    {
        $managerResponse = $this->manager->destroy($id);
        session()->flash('activeTab', 'criteria');
        session()->flash('Tab', 'update');

        if ($managerResponse->isSuccess()) {
            session()->flash('success', __('messages.default.success.delete', ['name' => __('words.ProgrammingLevelItemCriteria')]));
            $rtn = response()->json(['success' => true]);
        } elseif ($managerResponse->isErrorDefault()) {
            session()->flash('error', __('messages.default.failed.delete', ['name' => __('words.ProgrammingLevelItemCriteria')]));
            $rtn = response()->json(['error' => true]);
        } else {
            session()->flash('error', __('messages.default.request.invalid'));
            $rtn = response()->json(['error' => true]);
        }

        return $rtn;
    }
}
