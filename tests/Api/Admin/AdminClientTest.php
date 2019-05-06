<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;
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
        Passport::actingAs($this->user);

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
        Passport::actingAs($this->user);

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
                    'role' => User::ROLE_CLIENT,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canUpdateClientData()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);

        // Find random client
        $client = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
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
        Passport::actingAs($this->user);

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
        Passport::actingAs($this->user);

        // Client
        $client = User::client()->first();
        $deletedId = $client->id;
        $response = $this->json('POST', route('api.admin.client.destroy', ['id' => $client->id]));
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.success.destroy'),
            ]);
        $this->assertNull(User::find($deletedId));
    }

    /**
     * @test
     */
    public function cannotDeleteIfClientIdIsNotFound()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);
        // Client
        $client_id = '13231o321p32';
        $response = $this->json('POST', route('api.admin.client.destroy', ['id' => $client_id]));
        $response
            ->assertStatus(self::RESPONSE_NOT_FOUND);
    }

    /**
     * @test
     */
    public function canSearchClient()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);
        $key = 'a';
        $response = $this->json('GET', route('api.admin.client.search', ['key' => $key]));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->clients);
        $this->paginationTest($data->clients);

        $sampleResult = $data->clients->data[0];
        $name = $sampleResult->first_name . ' ' . $sampleResult->last_name;

        $isFound = false;
        if (Str::contains($name, $key))
            $isFound = true;
        elseif (Str::contains($sampleResult->email, $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }

    /**
     * @test
     */
    public function canSearchOnFirstName()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);

        // Search from database - find firstname
        $randomUser = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $key = substr($randomUser->first_name, 0, 3);
        $response = $this->json('GET', route('api.admin.client.search', ['key' => $key]));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->clients);
        $this->paginationTest($data->clients);

        $sampleResult = $data->clients->data[0];
        $name = $sampleResult->first_name;

        $isFound = false;
        if (Str::contains($name, $key))
            $isFound = true;
        elseif (Str::contains($sampleResult->email, $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }

    /**
     * @test
     */
    public function canSearchOnLastName()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);

        // Search from database - find last_name
        $randomUser = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $key = substr($randomUser->last_name, 0, 3);
        $response = $this->json('GET', route('api.admin.client.search', ['key' => $key]));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->clients);
        $this->paginationTest($data->clients);

        $sampleResult = $data->clients->data[0];
        $name = $sampleResult->last_name;

        $isFound = false;
        if (Str::contains($name, $key))
            $isFound = true;
        elseif (Str::contains($sampleResult->email, $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }

    /**
     * @test
     */
    public function canSearchOnFullName()
    {
        $this->loggedUserAsAdmin();
        Passport::actingAs($this->user);

        // Search from database - find last_name
        $randomUser = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $key = $randomUser->first_name . ' ' . $randomUser->last_name;
        $response = $this->json('GET', route('api.admin.client.search', ['key' => $key]));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->clients);
        $this->paginationTest($data->clients);

        $sampleResult = $data->clients->data[0];
        $fullName = $sampleResult->first_name . ' ' . $sampleResult->last_name;

        $isFound = false;
        if (Str::contains($fullName, $key))
            $isFound = true;
        elseif (Str::contains($sampleResult->email, $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }
}
