<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendResetPasswordRequest;

class PasswordController extends Controller
{
    /**
     * Send reset password link
     *
     * @param ResetPasswordRequest $response
     * @return response
     */
    public function sendResetPassword(SendResetPasswordRequest $request)
    {
        
    }
}
