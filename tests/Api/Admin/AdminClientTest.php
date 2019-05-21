<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->asAdmin();

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
        $this->asAdmin();

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
    public function newClientOrUserHaveNowACode()
    {
        $this->asAdmin();

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

        $newClient = $this->getPostResponse($response)->client;

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

        $this->assertEquals($newClient->code, int_to_code($newClient->id));
        $this->assertEquals($newClient->id, code_to_int($newClient->code));
    }

    /**
     * @test
     */
    public function canUpdateClientData()
    {
        $this->asAdmin();

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
        $this->asAdmin();

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
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error')
            ])
            ->assertJsonValidationErrors(['id']);
    }

    /**
     * @test
     */
    public function canDestroyClient()
    {
        $this->asAdmin();

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
        $this->asAdmin();
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
        $this->asAdmin();
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
        elseif (Str::contains(strtolower($sampleResult->email), $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }

    /**
     * @test
     */
    public function canSearchOnFirstName()
    {
        $this->asAdmin();

        // Search from database - find firstname
        $randomUser = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $key = substr($randomUser->first_name, 0, 3);
        $key = strtolower($key);
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
        if (Str::contains(strtolower($name), $key))
            $isFound = true;
        elseif (Str::contains(strtolower($sampleResult->email), $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }

    /**
     * @test
     */
    public function canSearchOnLastName()
    {
        $this->asAdmin();

        // Search from database - find last_name
        $randomUser = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $key = substr($randomUser->last_name, 0, 3);
        $key = strtolower($key);

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
        if (Str::contains(strtolower($name), $key))
            $isFound = true;
        elseif (Str::contains(strtolower($sampleResult->email), $key))
            $isFound = true;
        elseif (Str::contains(strtolower($sampleResult->first_name), $key))
            $isFound = true;

        $this->assertTrue($isFound);
    }

    /**
     * @test
     */
    public function canGetClientDetails()
    {
        $this->asAdmin();

        // Get random client
        $randomUser = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $code = $randomUser->code;

        $response = $this->json('GET', route('api.admin.client.details', ['code' => $code]));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
                'client' => [
                    'id' => $randomUser->id,
                    'email' => $randomUser->email,
                    'username' => $randomUser->username,
                ]
            ]);

        // Can get dispatcher data
        $this->assertObjectHasAttribute('dispatcher', $data->client);
    }

    /**
     * @test
     */
    public function canUpdateClientPaymentMode()
    {
        $this->asAdmin();

        // Find random client
        $client = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $oldPaymentMode = $client->payment_mode;

        $newPaymentMode = $oldPaymentMode == 1 ? 0 : 1;

        $response = $this->json('POST', route('api.admin.client.update.payment_mode', [
            'id' => $client->id
        ]), [
            'id' => $client->id,
            'payment_mode' => $newPaymentMode,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.client.manage.success.update_payment_mode'),
                'client' => [
                    'id' => $client->id,
                    'email' => $client->email,
                    'payment_mode' => $newPaymentMode,
                ],
            ]);
    }

    /**
     * @test
     */
    public function cannotUpdateCLientPaymentModeIfIdOrPaymentModeIsInvalidValue()
    {
        $this->asAdmin();

        // Client does not exist
        $client_code = '23123ao323opeoasde1';
        $client_id = '23123ao323opeoasde1';

        $response = $this->json('POST', route('api.admin.client.update.payment_mode', ['code' => $client_code]), [
            'id' => $client_id,
            'payment_mode' => 1,
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error')
            ])
            ->assertJsonValidationErrors(['id']);

        //** Test if cannot update if payment_mode is invalid
        // Find random client
        $client = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $response = $this->json('POST', route('api.admin.client.update.payment_mode', ['code' => $client->code]), [
            'id' => $client->id,
            'payment_mode' => 100,
        ]);

        $response
        ->assertStatus(self::RESPONSE_CLIENT_ERROR)
        ->assertJson([
            'success' => false,
            'message' => trans('validation.error')
        ])
        ->assertJsonValidationErrors(['payment_mode']);
    }

    /**
     * @test
     */
    public function adminCanAddDispatchModeOnUser()
    {
        $this->asAdmin();

        // Find random client
        $client = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $name = $client->first_name . ' ' . $client->last_name;

        $newFirstName = $this->faker->firstName;
        $newLastName = $this->faker->lastName;

        // Get dispatcher mode
        $dispatcher = $this->findRandomData('dispatchers');

        $response = $this->json('POST', route('api.admin.client.update', ['id' => $client->id]), [
            'id' => $client->id,
            'email' => $client->email,
            'username' => $client->username,
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
            'dispatcher_id' => $dispatcher->id,
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
                    'dispatcher_id' => $dispatcher->id,
                ],
            ]);

        // Check database data if match
        $user = User::find($client->id);
        $this->assertEquals($user->dispatcher_id, $dispatcher->id);
    }

    /**
     * @test
     */
    public function cannotUpdateClientIfDispatcherIdNotExist()
    {
        $this->asAdmin();

        // Client does not exist
        $dispatcherId = '23123ao323opeoasde1';

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
            'dispatcher_id' => $dispatcherId,
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error'),
                'errors' => [
                    'dispatcher_id' => [trans('message.admin.client.error.dispatcher_not_found')]
                ]
            ])
            ->assertJsonValidationErrors(['dispatcher_id']);
    }

    /**
     * @test
     */
    public function userCanGetDispatcherDataRelationship()
    {
        // Find random client
        $client = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $user = User::with('dispatcher')->find($client->id);

        $this->assertObjectHasAttribute('dispatcher', $user);
    }
}
