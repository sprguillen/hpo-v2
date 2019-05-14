<?php

namespace Tests\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Service;

class AdminServiceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetServicesList()
    {
        $this->asAdmin();

        $response = $this->json('GET', route('api.admin.services'));

        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->services);
        $this->paginationTest($data->services);

    }

    /**
     * @test
     */
    public function canStoreNewService()
    {
        $this->asAdmin();

        $code = $this->getRandomUniqueData('services', 'code', 'words', ['nb' => 3, 'asText' => true]);
        $name = $this->getRandomUniqueData('services', 'name', 'bs');
        $default_cost = $this->faker->numberBetween(100, 10000);

        $response = $this->json('POST', route('api.admin.services.store'), [
            'code' => $code,
            'name' => $name,
            'default_cost' => $default_cost,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.success.store'),
                'service' => [
                    'code' => $code,
                    'name' => $name,
                    'default_cost' => $default_cost,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminUpdateService()
    {
        $this->asAdmin();

        // Find random client
        $service = $this->findRandomData('services');
        $name = $service->name;
        $newName = $this->getRandomUniqueData('services', 'name', 'bs');

        $response = $this->json('POST', route('api.admin.services.update', ['id' => $service->id]), [
            'id' => $service->id,
            'name' => $newName,
            'code' => $service->code,
            'default_cost' => $service->default_cost,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.success.update', ['name' => $name]),
                'service' => [
                    'id' => $service->id,
                    'code' => $service->code,
                    'name' => $newName,
                    'default_cost' => $service->default_cost,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminDeleteService()
    {
        $this->asAdmin();

        $service = Service::first();
        $deletedId = $service->id;
        $response = $this->json('POST', route('api.admin.services.destroy', ['id' => $service->id]));
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.success.destroy'),
            ]);
        $this->assertNull(Service::find($deletedId));
    }
}
