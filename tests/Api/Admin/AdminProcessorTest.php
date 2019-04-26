<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminProcessorTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetProcessorList()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        $response = $this->json('GET', route('api.admin.processor'));

        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->processors);
        $this->paginationTest($data->processors);

    }

    /**
     * @test
     */
    public function canStoreNewProcessor()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        $email = $this->faker->email;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $username = $firstName . $lastName;

        $response = $this->json('POST', route('api.admin.processor.store'), [
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
                'message' => trans('message.admin.processor.success.store'),
                'processor' => [
                    'email' => $email,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'role' => User::ROLE_PROCESSOR,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canUpdateProcessorData()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        // Find random client
        $client = $this->findRandomData('users', ['role' => User::ROLE_PROCESSOR]);

        $name = $client->first_name . ' ' . $client->last_name;

        $newFirstName = $this->faker->firstName;
        $newLastName = $this->faker->lastName;

        $response = $this->json('POST', route('api.admin.processor.update', ['id' => $client->id]), [
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
                'message' => trans('message.admin.processor.success.update', ['name' => $name]),
                'processor' => [
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
    public function cannotUpdateProcessorIfIdGivenDoesNotExist()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        // Client does not exist
        $client_id = '23123ao3231';

        $newFirstName = $this->faker->firstName;
        $newLastName = $this->faker->lastName;

        $response = $this->json('POST', route('api.admin.processor.update', ['id' => $client_id]), [
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
    public function canDestroyProcessor()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');

        // Client
        $processor = User::processor()->first();
        $deletedId = $processor->id;

        $response = $this->json('POST', route('api.admin.processor.destroy', ['id' => $processor->id]));

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.processor.success.destroy'),
            ]);
        $this->assertNull(User::find($deletedId));
    }

    /**
     * @test
     */
    public function cannotDeleteIfProcessorIdIsNotFound()
    {
        $this->loggedUserAsAdmin();
        $this->actingAs($this->user, 'api');
        // Client
        $client_id = '13231o321p32';
        $response = $this->json('POST', route('api.admin.processor.destroy', ['id' => $client_id]));
        $response
            ->assertStatus(self::RESPONSE_NOT_FOUND);
    }
}
