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

        $email = $this->faker->email;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $username = $firstName . $lastName;

        $response = $this->json('POST', route('api.admin.client.store'), [
            'email' => $email,
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.success.store'),
                'client' => [
                    'email' => $email,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canUpdateClientData()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        // Find random client
        $client = $this->findRandomData('users');

        $newFirstName = $this->faker->firstName;
        $newLastName = $this->faker->lastName;

        $response = $this->json('POST', route('api.admin.client.update', ['id' => $client->id]), [
            'id' => $client->id,
            'email' => $client->email,
            'username' => $client->username,
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
        ]);
        // dd($response);
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.success.update', ['email' => $client->email]),
                'client' => [
                    'id' => $client->id,
                    'email' => $client->email,
                    'first_name' => $newFirstName,
                    'last_name' => $newLastName,
                ],
            ]);
    }
}
