@extends('layouts.userlayout.app')
@push('css')
    <link href="{{ rspr::vers('css/page/programmingLevelItemCriteria.css') }}" rel="stylesheet" />
@endpush
@section('bodyClass', 'dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')
@section('content')
    <div class="box">
        <div class="card card-primary card-tabs">
            <div id="spinner-overlay" class="text-center align-items-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">loading...</span>
                </div>
            </div>
            <div class="card-header p-0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ session('Tab') === 'update' ? '' : 'active' }}" id="custom-tabs-update-tab"
                            data-toggle="pill" href="#custom-tabs-update" role="tab" aria-controls="custom-tabs-update"
                            aria-selected="true">Programming Language
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ session('activeTab') === 'level' ? 'active' : '' }}"
                            id="custom-tabs-level-tab" data-toggle="pill" href="#custom-tabs-level" role="tab"
                            aria-controls="custom-tabs-level" aria-selected="false" data-id="{{ $project->id }}">Level
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ session('activeTab') === 'criteria' ? 'active' : '' }}"
                            id="custom-tabs-criteria-tab" data-toggle="pill" href="#custom-tabs-criteria" role="tab"
                            aria-controls="custom-tabs-criteria" aria-selected="false">Criteria
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ session('activeTab') === 'sub-criteria' ? 'active' : '' }}"
                            id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings"
                            role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Sub Criteria
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="height:75vh;max-height:80vh;">
                <div class="tab-content" style="height:73vh;">
                    <div class="tab-pane fade show
                {{ session('Tab') === 'update' ? '' : 'active' }}"
                        id="custom-tabs-update" role="tabpanel" aria-labelledby="custom-tabs-update-tab">
                        <form action="{{ route(__('messages.update_route'), $project->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <label>Language Name</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('language_name') ? ' is-invalid' : '' }}"
                                    name="language_name" value="{{ $project->language_name }}">
                                @include('assets.element.common.asset-el-validation-error', [
                                    'key' => 'language_name',
                                ])
                                <button type="submit" class="btn btn-primary float-right mt-5">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('activeTab') === 'level' ? 'active show' : '' }}"
                        id="custom-tabs-level" role="tabpanel" aria-labelledby="custom-tabs-level-tab">
                        <form action="{{ route(__('messages.store_or_update_level_route'), ['id' => $project->id]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body"
                                style="height: 60vh; max-height: 71vh; overflow-y: scroll; overflow-x: hidden;">
                                <div id="level-container">
                                    @if ($project->levels->isEmpty())
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-5">
                                                <label>Item Name</label>
                                                <input type="hidden" name="language_type"
                                                    value="{{ pms::mProgrammingLevelItem()::TYPE_PROGRAMMING_LANGUAGE }}">
                                                <input type="text" class="form-control" name="item_name[]">
                                            </div>
                                            <div class="col-sm-3 col-lg-2">
                                                <label>Rank Number</label>
                                                <input type="number" class="form-control" name="rank_number[]">
                                            </div>
                                            <div class="col-sm-3 col-lg-2">
                                                <label>Total Score</label>
                                                <input type="number" class="form-control" name="total_score[]">
                                            </div>
                                            <div class="col-sm-3 col-lg-3" style="position: relative;top: 30px;left: 57px;">
                                                <button type="button" class="btn btn-primary rounded-circle addLevel"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($project->levels as $i => $item)
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-5">
                                                    <label>Item Name</label>
                                                    <input type="hidden" class="form-control" name="level_id[]"
                                                        value="{{ $item->id }}">
                                                    <input type="hidden" name="language_type"
                                                        value="{{ pms::mProgrammingLevelItem()::TYPE_PROGRAMMING_LANGUAGE }}">
                                                    <input type="text" class="form-control" name="item_name[]"
                                                        value="{{ $item->item_name }}">
                                                </div>
                                                <div class="col-sm-3 col-lg-2">
                                                    <label>Rank Number</label>
                                                    <input type="number" class="form-control" name="rank_number[]"
                                                        value="{{ $item->rank_number }}">
                                                </div>
                                                <div class="col-sm-3 col-lg-2">
                                                    <label>Total Score</label>
                                                    <input type="number" class="form-control" name="total_score[]"
                                                        value="{{ $item->total_score }}">
                                                </div>
                                                <div class="col-sm-3 col-lg-3"
                                                    style="position: relative;top: 30px;left: 57px;">
                                                    <button type="button"
                                                        class="btn btn-primary rounded-circle addLevel"><i
                                                            class="fa-solid fa-plus"></i></button>
                                                    <button type=button
                                                        class="btn btn-danger rounded-circle deleteButtonLevel"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fa-solid fa-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-5"
                                style="margin-right: 129px;">Submit</button>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('activeTab') === 'criteria' ? 'active show' : '' }}"
                        id="custom-tabs-criteria" role="tabpanel" aria-labelledby="custom-tabs-criteria-tab">
                        <form action="{{ route(__('messages.store_or_update_criteria_route'), ['id' => $project->id]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body"
                                style="height:60vh;max-height:71vh;overflow-y: scroll; overflow-x: hidden;">
                                <div class="form-group" style="margin-top:-19px;">
                                    <select class="form-control" name="programming_level_item_id"
                                        id="programming_level_item_id" style="width:10%!important;">
                                        <option selected disabled>Select Level</option>
                                        @foreach ($project->levels as $item)
                                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="selectedLevelData">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-5"
                                style="margin-right: 139px;">Submit</button>
                        </form>
                        <div class="pagination-container"
                            style="display: flex;justify-content: center; align-items: center;">
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('activeTab') === 'sub-criteria' ? 'active show' : '' }}"
                        id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                        <form
                            action="{{ route(__('messages.store_or_update_sub_criteria_route'), ['id' => $project->id]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body"
                                style="height: 60vh; max-height: 71vh; overflow-y: scroll; overflow-x: hidden;">
                                <div class="d-flex" style="margin-left:26px;margin-top:11px;">
                                    <div class="form-group" style="margin-top:-31px;margin-left:-24px;">
                                        <select class="form-control" name="programming_level_item_id"
                                            id="programming_level_item_id_for_criteria">
                                            <option selected disabled>Select Level</option>
                                            @foreach ($project->levels as $item)
                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="selectedCriteriaData">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="selectedCriteriaDataDescription" style="margin-left:-20px;">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-5"
                                style="margin-right: 139px;
                        ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        const deleteUrl = "{{ route(__('messages.delete_level_route'), ['id' => ':id']) }}";
        const fetchDescription = "{{ route(__('messages.show_criteria_route'), ['id' => ':id']) }}";
        const deleteCriteriaUrl = "{{ route(__('messages.delete_criteria_route'), ['id' => ':id']) }}";
        const fetchCriteriaUrl = "{{ route(__('messages.show_sub_criteria_route'), ['id' => ':id']) }}";
        const deleteSubCriteriaUrl = "{{ route(__('messages.delete_sub_criteria_route'), ['id' => ':id']) }}";
        const fetchLevelItemUrl = "{{ route(__('messages.show_level_item_route'), ['id' => ':id']) }}";
        const programmingType = "{{ pms::mProgrammingLevelItem()::TYPE_PROGRAMMING_LANGUAGE }}";
    </script>
    <script src="{{ rspr::vers('js/page/ProgrammingLevelItem.js') }}" defer></script>
@endsection
