<?php

namespace Tests\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\User;

class PasswordTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canSendResetPassword()
    {
        $user = $this->findRandomData('users');

        $response = $this->json('POST', route('reset.password.send'), [
            'email' => $user->email,
        ]);
        
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.auth.password.reset.send', ['email' => $user->email]),
            ]);
    }

    /**
     * @test
     */
    public function cannotSendResetPasswordIfEmailNotExist()
    {
        $response = $this->json('POST', route('reset.password.send'), [
            'email' => 'email_does_not_exist@exist.not',
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @test
     */
    public function canResetUserPassword()
    {
        $user = $this->findRandomData('users');

        $response = $this->json('POST', route('reset.password.send'), [
            'email' => $user->email,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.auth.password.reset.send', ['email' => $user->email]),
            ]);

        $passwordReset = $this->findRandomData('password_resets', ['email' => $user->email]);

        $response = $this->json('POST', route('reset.password'), [
            'token' => $passwordReset->token,
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('passwords.reset'),
            ]);
    }
}
