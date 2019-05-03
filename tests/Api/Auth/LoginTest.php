<?php

namespace Tests\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
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
                'message' => trans('validation.error'),
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
        $passportCredentials = passport_client_credentials();

        $user = User::orderByRaw('RAND()')->first();

        $response = $this->json('POST', route('login'), [
            'username' => $user->username,
            'password' => 'secret',
            'client_id' => $passportCredentials->id,
            'client_secret' => $passportCredentials->secret,
            'grant_type' => 'password'
        ]);

        $responseData = $response->getOriginalContent();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.auth.login.success'),
                'access_token' => $responseData['access_token'],
                'refresh_token' => $responseData['refresh_token'],
            ]);

        // Check if response has `logged_in_user`
        $responseUser = $responseData['logged_in_user'];
        $this->assertArrayHasKey('logged_in_user', $responseData);
        $this->assertSame($user->id, $responseUser->id);
    }

    /**
     * @test
     */
    public function cannotPostLoginIfUserIsAlreadyLoggedIn()
    {
        $this->loggedUserClient();
        Passport::actingAs($this->user);

        $response = $this->json('POST', route('login'), [
            'username' => $this->user->username,
            'password' => 'secret',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'grant_type' => 'password'
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('message.auth.login.error.already_login'),
            ]);
    }
}
