<?php

namespace App\Http\Controllers\Api\Auth;

use Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\Auth\ResetUserPassword;
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
        // Create token
        $token = str_random(150) . Carbon::now()->timestamp;
        $user = User::where('email', $request->email)->firstOrFail();

        $passwordReset = new PasswordReset();
        $passwordReset->email = $request->email;
        $passwordReset->token = $token;
        $passwordReset->save();

        // Send email
        Mail::to($user)->send(new ResetUserPassword($passwordReset, $user));

        return successful(trans('message.auth.password.reset.send', ['email' => $request->email]));
    }

    /**
     * Reset user password - show reset password form
     *
     * @param sttring $token 
     */
    public function resetPasswordForm($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        return redirect()->route('home');
    }

    /**
     * Reset password
     *
     */
    public function resetPassword()
    {
        # code...
    }
}
