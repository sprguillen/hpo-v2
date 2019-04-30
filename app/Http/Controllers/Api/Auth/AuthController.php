<?php

namespace App\Http\Controllers\Api\Auth;

use Validator;
use Carbon\Carbon;
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
        if (!auth()->attempt($credentials)) {
            return errorify(trans('message.auth.login.error.credentials'));
        }

        $user = auth()->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return successful(trans('message.auth.login.success'), [
            'access_token' => [
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ],
            'logged_in_user' => [
                'username' => auth()->user()->username,
                'id' => auth()->user()->id
            ],
            'csrf_token' => csrf_token(),
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
        $request->user()->token()->revoke();
        auth('web')->logout();
        // auth()->logout();
        // session()->flush();

        return redirect('/');
    }
}
