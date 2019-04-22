<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminClientTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetClientList()
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

        $this->assertNotEmpty($data->clients);
        $this->paginationTest($data->clients);

    }

    /**
     * @test
     */
    public function canStoreNewClient()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        $response = $this->json('POST', route('api.admin.client.store'), [
            'email' => $this->faker->email,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'dispatchMode' => $this->faker->randomElement(['send', 'online']),
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('admin.client.store.success'),
            ]);
    }

    /**
     * @test
     */
    public function createUserNameDuplicateMustIncrement()
    {
        # code...
    }
}
