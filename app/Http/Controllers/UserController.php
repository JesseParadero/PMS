<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Managers\UserManager;
use App\Models\User;
use App\ResponseCodes\Manager\UserManagerResponse;


class UserController extends Controller
{
    protected UserManager $manager;

    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    public function showLoginForm()
    {
        return view('pages.guest.auth.login');
    }

    public function index()
    {
        $managerResponse = $this->manager->all();
        return view('pages.auth.dashboard.employee', ['users' => $managerResponse->data['data']]);
    }

    public function update(User $user, UserRequest $request)
    {
        $managerResponse = $this->manager->update($user->id);

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('employee.index')
                ->with('success', __('message.default.success.update', ['name' => __('words.User')]));
        } elseif ($managerResponse->isErrorDefault()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('message.default.failed.update', ['name' => __('words.User')]));
        } elseif ($managerResponse->is(UserManagerResponse::UPDATE_ERROR_NO_USER_FOUND)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('message.default.failed.update', ['name' => __('words.User')]));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('message.default.request.invalid'));
        }

        return $rtn;
    }

    public function register(UserRequest $request)
    {
        $rtn = null;
        $managerResponse = $this->manager->store();

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('success', __('messages.default.success.create', ['name' => __('words.User')]));
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

    public function login()
    {
        $rtn = null;
        $managerResponse = $this->manager->login();

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('user.index')
                ->with('success', __('messages.LoginSuccessfully'));
        } elseif ($managerResponse->is(UserManagerResponse::LOGIN_ERROR_INVALID_CREDENTIALS)) {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.InvalidCredential'));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;

    }
    public function logout()
    {
        $rtn = null;
        $managerResponse = $this->manager->logout();

        if ($managerResponse->isSuccess()) {
            $rtn = redirect()
                ->route('login')
                ->with('success', __('messages.LogoutSuccessfully'));
        } else {
            $rtn = redirect()
                ->back()
                ->withInput()
                ->with('error', __('messages.default.request.invalid'));
        }

        return $rtn;
    }
}
