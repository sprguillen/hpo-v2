<?php

namespace Tests\Api\Admin\Service;

use Tests\TestCase;
use App\Models\User;
use App\Models\ClientService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminClientServiceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canStoreClientOnService()
    {
        $this->asAdmin();

        // Get client user and a service
        $user = $this->findRandomData('users', ['role' => User::ROLE_CLIENT]);
        $service = $this->findRandomData('services');
        $price = $this->faker->numberBetween(1, 10000);

        $name = User::find($user->id)->full_name;

        $response = $this->json('POST', route('api.admin.service.client.store'), [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'price' => $price,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.client.success.store', ['name' => $name]),
                'client' => [
                    'user_id' => $user->id,
                    'service_id' => $service->id,
                    'price' => $price,
                ],
            ]);
    }

    /**
     * @test
     */
    public function cannotStoreNewClientServicesIfUserIsNotClient()
    {
        $this->asAdmin();

        // Get client user and a service
        $user = $this->findRandomData('users', ['role' => User::ROLE_ADMIN]); // User is not client
        $service = $this->findRandomData('services');
        $price = $this->faker->numberBetween(1, 10000);

        $response = $this->json('POST', route('api.admin.service.client.store'), [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'price' => $price,
        ]);

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error'),
            ])
            ->assertJsonValidationErrors(['user_id']);
    }

    /**
     * @test
     */
    public function canAdminUpdateClientServicePrice()
    {
        $this->asAdmin();

        // Find random client service
        $client = $this->findRandomData('client_services');

        $name = User::find($client->user_id)->full_name;

        $oldPrice = $client->price;
        $newPrice = $this->faker->numberBetween(1, 10000);

        $response = $this->json('POST', route('api.admin.service.client.update', ['id' => $client->id]), [
            'id' => $client->id,
            'price' => $newPrice,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.client.success.update', ['name' => $name]),
                'client' => [
                    'id' => $client->id,
                    'user_id' => $client->user_id,
                    'service_id' => $client->service_id,
                    'price' => $newPrice,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminDeleteClientService()
    {
        $this->asAdmin();

        $client = ClientService::first();
        $name = User::find($client->user_id)->full_name;
        $deletedId = $client->id;
        $userId = $client->user_id;
        $serviceId = $client->service_id;

        $response = $this->json('POST', route('api.admin.service.client.destroy', ['id' => $deletedId]));
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.client.success.destroy', ['name' => $name]),
            ]);
        $this->assertNull(ClientService::find($deletedId));
    }
}
