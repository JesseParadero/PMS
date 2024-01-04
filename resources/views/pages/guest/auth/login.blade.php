@extends('layouts.common.app')
@section('bodyClass', 'pg-login login-page')
@section('content')
    <div class="login-box">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item" style="width: 50%;
                    text-align: center;font-weight: 600;">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                            href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                            aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item" style="width: 50%;
                    text-align: center;font-weight: 600;">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                            href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                            aria-selected="false">Register</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">
                        <form action="{{ route('user.submit_login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password">
                            </div>
                            <div class="social-auth-links text-center mb-3">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-one-profile-tab">
                        <form action="{{ route('user.register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Firstname</label>
                                <input type="text" class="form-control" name="firstname" placeholder="Enter firstname">
                            </div>
                            <div class="form-group">
                                <label for="">Lastname</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Enter lastname">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password">
                            </div>
                            <div class="social-auth-links text-center mb-3">
                                <button type="submit" id="btn_Register" class="btn btn-block btn-primary">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
