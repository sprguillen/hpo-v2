<?php

namespace App\Http\Controllers\Api\Auth;

use Mail;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\Auth\ResetUserPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
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
     * Show reset password form
     *
     * @param sttring $token
     * @return view
     */
    public function resetPasswordForm($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        return redirect()->route('home', ['any' => 'reset-password/' . $token]);
    }

    /**
     * Reset password
     *
     * @return response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->firstOrFail();

        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        return successful(trans('passwords.reset'));
    }
}
