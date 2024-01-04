@extends('layouts.userlayout.app')
@section('bodyClass', 'dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')
@section('contentHeaderTitle')
    {{ __('words.language') }}
@endsection
@section('content')
    <div class="box">
        <div class="card card-container">
            <div class="card-body" style="height:75vh;max-height:80vh;">
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addModal">
                    <i class="nav-icon fas fa-plus"></i> Add
                </button>
                <table class="table table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>LANGUAGE NAME</th>
                            <th>CREATED_AT</th>
                            <th>UPDATED_AT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->language_name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route(__('messages.edit_route'), $item->id) }}" type="button"
                                            class="btn btn-success">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#delete_modal{{ $item->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>

                                    </td>
                                </tr>
                                <div>
                                    <div class="modal fade" id="delete_modal{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center>
                                                        <b>Are you sure you want to delete this record ?</b>
                                                    </center>
                                                </div>
                                                <form action="{{ route(__('messages.delete_route'), $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">No
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-primary deleteButton">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $data->links('layouts.auth.pagination') }}
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Language</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route(__('messages.store_route')) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Language Name</label>
                            <input type="text"
                                class="form-control{{ $errors->has('language_name') ? ' is-invalid' : '' }}"
                                name="language_name">
                            @include('assets.element.common.asset-el-validation-error', [
                                'key' => 'language_name',
                            ])
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary addButton">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
