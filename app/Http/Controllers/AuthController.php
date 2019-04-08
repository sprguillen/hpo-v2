<?php

namespace App\Http\Controllers;

use API;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;

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
        $credentials = $request->only(['username', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Username/password does not match'], 400);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
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
