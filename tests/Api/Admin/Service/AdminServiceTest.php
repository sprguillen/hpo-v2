<?php

namespace Tests\Api\Admin\Service;

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

        // Test `test_count` exists
        $this->assertObjectHasAttribute('tests_count', $data->services->data[0]);
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

    /**
     * @test
     */
    public function canAdminGetServiceDetailsWithClient()
    {
        $this->asAdmin();

        $service = $this->findRandomData('services');

        $response = $this->json('GET', route('api.admin.service.details', ['code' => $service->code]));

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'service' => [
                    'id' => $service->id,
                    'code' => $service->code,
                    'name' => $service->name,
                ]
            ]);

        // Test response has clients data
        $data = $this->getPostResponse($response);

        $service = $data->service;

        $this->assertObjectHasAttribute('clients', $service);
        // Test client is an array
        $this->assertTrue(is_array($service->clients));
    }

    /**
     * @test
     */
    public function cannotGetServiceDetailsIfCodeIsNotFound()
    {
        $this->asAdmin();

        $code = 'qe231ad231po1p2o31p23o12312312asdaeqe1234o';

        $response = $this->json('GET', route('api.admin.service.details', ['code' => $code]));

        $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('message.admin.service.not_found'),
            ]);
    }

    /**
     * @test
     */
    public function canSearchOnServiceUsingCodeOrName()
    {
        $this->asAdmin();

        $randomService = $this->findRandomData('services');
        $key = substr($randomService->name, 0, 3);
        $key = strtolower($key);

        $response = $this->json('GET', route('api.admin.services.search', ['key' => $key]));

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
    public function canImportCsvFileOnServices()
    {
        $this->asAdmin();
        $file = $this->getUploadableFile(base_path("tests/Fixtures/ONLINE_ORDER_IMPORT.csv"));

        $response = $this->json('POST', route('api.admin.service.import'), [
            'file' => $file
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.service.success.import'),
            ]);
    }
}
