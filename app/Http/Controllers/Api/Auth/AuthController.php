<?php

namespace App\Http\Controllers\Api\Auth;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AccessTokenController
{
    /**
     * Login
     *
     * @param  LoginRequest $request
     * @return response
     */
    public function login(ServerRequestInterface $serverRequest, LoginRequest $request)
    {
        if (auth()->check()) {
            return errorify(trans('message.auth.login.error.already_login'));
        }

        $issueToken = $this->issueToken($serverRequest);
        
        if ($issueToken->status() == Response::HTTP_OK) {
            $tokenResult = json_decode($issueToken->getContent(), true);

            return successful(trans('message.auth.login.success'), [
                'access_token' => $tokenResult['access_token'],
                'refresh_token' => $tokenResult['refresh_token']
            ]);
        }

        return errorify(trans('message.auth.login.error.credentials'));

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
        // auth('web')->logout();
        // auth()->logout();
        // session()->flush();

        return redirect('/');
    }

    /**
     * Get user access_token
     *
     * @return response
     */
    public function userToken()
    {
        # code...
    }
}
