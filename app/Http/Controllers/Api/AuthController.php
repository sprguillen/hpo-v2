<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $userdata = [
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ];

        $rules = [
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        $validator = Validator::make($userdata, $rules);

        if ($validator->passes()) {
            User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'username' => $request->username
            ]);

            return response()->json([
                'message' => 'Successfully registered user!'
            ], 201);
        } else {
            $errors = $validator->errors();
            foreach($errors->all() as $message) {
                if ($message) {
                    return response()->json([
                        'error' => $message
                    ], 422);
                }
            }
        }
    }

    public function login(Request $request)
    {
        $checkUser = User::where('username', $request->username)->first();

        if (!$checkUser) {
            return response()->json(['message' => 'User does not exist!'], 400);
        }

        $credentials = $request->only(['username', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Username/password does not match!'], 400);
        }

        return response()->json([
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

    public function clientRegister(Request $request)
    {
        $userdata = [
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dispatch_mode' => $request->dispatch_mode
        ];
    }
}
