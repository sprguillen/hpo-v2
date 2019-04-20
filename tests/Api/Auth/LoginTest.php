<?php

namespace Tests\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use JWTAuth;

class LoginTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function cannotLoginIfUserNameNotExists()
    {
        $response = $this->json('POST', route('login'), [
            'username' => 'none_existing_username',
            'password' => 'secret'
        ]);
        
        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJsonValidationErrors(['username'])
            ->assertJson([
                'success' => false,
                'message' => trans('error.validation'),
            ]);
    }

    /**
     * @test
     */
    public function cannotLoginIfUserNameAndPasswordNotMatch()
    {
        $randomUser = User::orderByRaw('RAND()')->first();

        $response = $this->json('POST', route('login'), [
            'username' => $randomUser->username,
            'password' => 'secret123'
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('message.auth.login.error.credentials')
            ]);
    }

    /**
     * @test
     */
    public function canLogin()
    {
        $randomUser = User::orderByRaw('RAND()')->first();

        $response = $this->json('POST', route('login'), [
            'username' => $randomUser->username,
            'password' => 'secret'
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.auth.login.success'),
                'access_token' => [
                    'token_type' => 'bearer',
                ],
                'logged_in_user' => [
                    'username' => $randomUser->username,
                    'id' => $randomUser->id
                ]
            ]);
    }
}
