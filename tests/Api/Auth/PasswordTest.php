<?php

namespace Tests\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PasswordTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canResetPassword()
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
    public function cannotResetPasswordIfEmailNotExist()
    {
        $response = $this->json('POST', route('reset.password.send'), [
            'email' => 'email_does_not_exist@exist.not',
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJsonValidationErrors(['email']);
    }
}
