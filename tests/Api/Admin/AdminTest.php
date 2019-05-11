<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\User;

class AdminTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canAccessToAdminRoutes()
    {
        $this->asAdmin();

        $response = $this->json('GET', route('api.admin.client'));

        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

    }

    /**
     * @test
     */
    public function cannotAccessIfUserIsNotAdmin()
    {
        $this->asClient();

        $response = $this->json('GET', route('api.admin.client'));

        $response
            ->assertStatus(self::RESPONSE_REDIRECTION);
    }

    /**
     * @test
     */
    public function cannotAccessIfUserIsNotLoggedIn()
    {
        $response = $this->json('GET', route('api.admin.client'));
        $response
            ->assertStatus(self::RESPONSE_UNAUTHORIZED);
    }
}
