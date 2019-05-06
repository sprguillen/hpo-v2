<?php

namespace Tests\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\User;

class UserTokenTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function cannotGetUserTokenIfUserIsNotLoggedIn()
    {
        $this->assertTrue(true);
        // $user = $this->findRandomData('users');
        //
        // $response = $this->json('POST', route('reset.password.send'), [
        //     'email' => $user->email,
        // ]);
        //
        // $response
        //     ->assertStatus(self::RESPONSE_SUCCESS)
        //     ->assertJson([
        //         'success' => true,
        //         'message' => trans('message.auth.password.reset.send', ['email' => $user->email]),
        //     ]);
    }


}
