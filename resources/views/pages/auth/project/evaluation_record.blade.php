@extends('layouts.auth.app')
@section('bodyClass', 'pg-')
@section('contentHeader')
@section('contentHeaderTitle')
    {{ __('words.evaluation') }}
@endsection
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" title="Add Record">
    <i class="nav-icon fas fa-plus"></i> Add
</button>
@endsection
@section('content')
<div class="box">
    <div class="card card-container">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>EMPLOYEE_ID</th>
                        <th>PROGRAMMING_ID</th>
                        <th>PROGRAMMING_TYPE</th>
                        <th>TOTAL_SCORE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6">No Data Found</td>
                        </tr>
                    @else
                        @foreach ($data as $list)
                            <tr>
                                <td>{{ $list['id'] }}</td>
                                <td>{{ $list['employee_id'] }}</td>
                                <td>{{ $list['programming_id'] }}</td>
                                <td>{{ $list['programming_type'] }}</td>
                                <td>{{ $list['total_score'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#view_more_modal{{ $list['id'] }}" title="View More">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#update_modal{{ $list['id'] }}" title="Update Record">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete_modal{{ $list['id'] }}" title="Delete Record">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- View More Modal -->
                            <div class="modal fade" id="view_more_modal{{ $list['id'] }}" tabindex="-1"
                                role="dialog" aria-labelledby="viewMoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="text" class="form-control" value="{{ $list['id'] }}"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Employee ID</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['employee_id'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Programming ID</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['programming_id'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Programming Type</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['programming_type'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Score</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['total_score'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Evaluation Date</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['evaluation_date'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Created At</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['created_at'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Updated At</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $list['updated_at'] }}" readonly>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--End of View More -->
                            <!-- Update Modal -->
                            <div class="modal fade" id="update_modal{{ $list['id'] }}" tabindex="-1" role="dialog"
                                aria-labelledby="viewMoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Update Record</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form
                                            action="{{ route(__('messages.evaluation.update'), ['evaluation' => $list['id']]) }}"
                                            method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text"
                                                        class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}"
                                                        name="employee_id" value="{{ $list['employee_id'] }}">
                                                    @include(
                                                        'assets.element.common.asset-el-validation-error',
                                                        [
                                                            'key' => 'employee_id',
                                                        ]
                                                    )
                                                </div>
                                                <div class="form-group">
                                                    <label>Programming ID</label>
                                                    <input type="text"
                                                        class="form-control{{ $errors->has('programming_id') ? ' is-invalid' : '' }}"
                                                        name="programming_id" value="{{ $list['programming_id'] }}">
                                                    @include(
                                                        'assets.element.common.asset-el-validation-error',
                                                        [
                                                            'key' => 'programming_id',
                                                        ]
                                                    )
                                                </div>
                                                <div class="form-group">
                                                    <label>Programming Type</label>
                                                    <input type="text"
                                                        class="form-control{{ $errors->has('programming_type') ? ' is-invalid' : '' }}"
                                                        name="programming_type"
                                                        value="{{ $list['programming_type'] }}">
                                                    @include(
                                                        'assets.element.common.asset-el-validation-error',
                                                        [
                                                            'key' => 'programming_type',
                                                        ]
                                                    )
                                                </div>
                                                <div class="form-group">
                                                    <label>Total Score</label>
                                                    <input type="text"
                                                        class="form-control{{ $errors->has('total_score') ? ' is-invalid' : '' }}"
                                                        name="total_score" value="{{ $list['total_score'] }}">
                                                    @include(
                                                        'assets.element.common.asset-el-validation-error',
                                                        [
                                                            'key' => 'total_score',
                                                        ]
                                                    )
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Update Modal -->
                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete_modal{{ $list['id'] }}" tabindex="-1"
                                role="dialog" aria-labelledby="viewMoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form
                                            action="{{ route(__('messages.evaluation.destroy'), ['evaluation' => $list['id']]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <center>
                                                    <b>Are you sure you want to delete this record?</b>
                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    No
                                                </button>
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Delete Modal -->
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route(__('messages.evaluation.store')) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text"
                            class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}"
                            name="employee_id">
                        @include('assets.element.common.asset-el-validation-error', [
                            'key' => 'employee_id',
                        ])
                    </div>
                    <div class="form-group">
                        <label>Programming ID</label>
                        <input type="text"
                            class="form-control{{ $errors->has('programming_id') ? ' is-invalid' : '' }}"
                            name="programming_id">
                        @include('assets.element.common.asset-el-validation-error', [
                            'key' => 'programming_id',
                        ])
                    </div>
                    <div class="form-group">
                        <label>Programming Type</label>
                        <input type="text"
                            class="form-control{{ $errors->has('programming_type') ? ' is-invalid' : '' }}"
                            name="programming_type">
                        @include('assets.element.common.asset-el-validation-error', [
                            'key' => 'programming_type',
                        ])
                    </div>
                    <div class="form-group">
                        <label>Total Score</label>
                        <input type="text"
                            class="form-control{{ $errors->has('total_score') ? ' is-invalid' : '' }}"
                            name="total_score">
                        @include('assets.element.common.asset-el-validation-error', [
                            'key' => 'total_score',
                        ])
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End of Add Modal -->
@endsection
