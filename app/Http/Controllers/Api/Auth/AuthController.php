<?php

namespace App\Http\Controllers\Api\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @param  LoginRequest $request
     * @return response
     */
    public function login(LoginRequest $request)
    {
        if (auth()->check()) {
            return errorify(trans('message.auth.login.error.already_login'));
        }

        $credentials = $request->only(['username', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return errorify(trans('message.auth.login.error.credentials'));
        }

        return successful(trans('message.auth.login.success'), [
            'access_token' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ],
            'logged_in_user' => [
                'username' => auth()->user()->username,
                'id' => auth()->user()->id
            ]
        ]);
    }

    /**
     * Log the user out of the application (override).
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author goper
     */
    public function logout(Request $request)
    {
        auth()->logout();
        session()->flush();

        return redirect('/');
    }
}
