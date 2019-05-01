<?php

namespace App\Mail\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetUserPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $passwordReset;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PasswordReset $passwordReset, User $user)
    {
        $this->passwordReset = $passwordReset;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.sendResetPassword', [
            'passwordReset' => $this->passwordReset,
            'user' => $this->user
        ]);
    }
}
