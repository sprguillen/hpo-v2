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
        $name = $client->first_name . ' ' . $client->last_name;

        $newFirstName = $this->faker->firstName;
        $newLastName = $this->faker->lastName;

        $response = $this->json('POST', route('api.admin.client.update', ['id' => $client->id]), [
            'id' => $client->id,
            'email' => $client->email,
            'username' => $client->username,
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.success.update', ['name' => $name]),
                'client' => [
                    'id' => $client->id,
                    'email' => $client->email,
                    'first_name' => $newFirstName,
                    'last_name' => $newLastName,
                ],
            ]);
    }

    /**
     * @test
     */
    public function cannotUpdateClientIfIdGivenDoesNotExist()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        // Client does not exist
        $client_id = '23123ao3231';

        $newFirstName = $this->faker->firstName;
        $newLastName = $this->faker->lastName;

        $response = $this->json('POST', route('api.admin.client.update', ['id' => $client_id]), [
            'id' => $client_id,
            'email' => $this->faker->email,
            'username' => $newFirstName,
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJsonValidationErrors(['id']);
    }

    /**
     * @test
     */
    public function canDestroyClient()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        // Client
        $client = User::client()->first();

        $response = $this->json('POST', route('api.admin.client.destroy', ['id' => $client->id]));

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.success.destroy'),
            ]);
    }

    /**
     * @test
     */
    public function cannotDeleteIfClientIdIsNotFound()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');
        // Client
        $client_id = '13231o321p32';
        $response = $this->json('POST', route('api.admin.client.destroy', ['id' => $client_id]));
        $response
            ->assertStatus(self::RESPONSE_NOT_FOUND);
    }
}
