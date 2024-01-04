@extends('layouts.auth.app')
@section('bodyClass', 'pg-')
@section('contentHeader')
@section('contentHeaderTitle')
    {{ __('words.criteria') }}
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
                        <th>CRITERIA DESCRIPTION</th>
                        <th>CREATED_AT</th>
                        <th>UPDATED_AT</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isNotEmpty())
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($data as $list)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $list['criteria_description'] }}</td>
                                <td>{{ $list['created_at'] }}</td>
                                <td>{{ $list['updated_at'] }}</td>
                                <td>
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
                                            action="{{ route(__('messages.development.update'), ['development' => $list['id']]) }}"
                                            method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text"
                                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                        name="description" value="{{ $list['criteria_description'] }}">
                                                    @include(
                                                        'assets.element.common.asset-el-validation-error',
                                                        [
                                                            'key' => 'description',
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
                            <div class="modal fade" id="delete_modal{{ $list['id'] }}" tabindex="-1" role="dialog"
                                aria-labelledby="viewMoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form
                                            action="{{ route(__('messages.development.destroy'), ['development' => $list['id']]) }}"
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
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route(__('messages.development.store')) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text"
                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            name="description">
                        @include('assets.element.common.asset-el-validation-error', [
                            'key' => 'description',
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
@endsection
