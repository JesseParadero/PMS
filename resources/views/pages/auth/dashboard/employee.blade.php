@extends('layouts.userlayout.app')
@section('bodyClass', 'dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')
@section('contentHeaderTitle')
    {{ __('words.employee') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @php
                    $user_details = Auth::user();
                @endphp
                @if ($user_details->role == 2 || $user_details->role == 3)
                    <button class="btn btn-info float-right mr-5" data-toggle="modal" data-target="#addModal">Add
                        Employee</button>
                @endif
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>POSITION</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                                @if ($user_details->id != $user->id)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ ucfirst($user->firstname) . ' ' . ucfirst($user->lastname) }}</td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if ($user->role == 0)
                                                Invalid
                                            @elseif($user->role == 1)
                                                Junior Software Engineer
                                            @elseif($user->role == 2)
                                                Senior Software Engineer
                                            @elseif($user->role == 3)
                                                CEO
                                            @endif
                                        </td>
                                        @if ($user_details->role == 2 || $user_details->role == 3)
                                            <td>
                                                <a type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#update_modal{{ $user->id }}">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete_modal{{ $user->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                                <a href="{{ route('evaluate.user', $user->id) }}" class="btn btn-primary">
                                                    <i class="fa-solid fa-list-check"></i>
                                                    Evaluate
                                                </a>
                                            </td>
                                        @endif
                                        <div class="modal fade" id="delete_modal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <center>
                                                            <b>Are you sure you want to delete this record ?</b>
                                                        </center>
                                                    </div>
                                                    <form action="{{ route(__('messages.delete_route'), $user->id) }}"
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
                                        <div class="modal fade" id="update_modal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Update Employee</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route(__('messages.delete_route'), $user->id) }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control" name="firstname">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" class="form-control" name="lastname">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" name="password">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary addButton">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No User Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.register') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
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
