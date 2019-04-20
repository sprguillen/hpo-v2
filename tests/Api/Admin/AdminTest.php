<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

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
        $this->loggedUserClient();
        $this->actingAs($this->user, 'api');

        $response = $this->json('GET', route('api.admin.client'));
        $response
            ->assertStatus(self::RESPONSE_REDIRECTION);
    }
}
