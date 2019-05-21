<?php

namespace Tests\Api\Admin\System;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dispatcher;

class AdminDispatcherTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetDispatcherList()
    {
        $this->asAdmin();

        $response = $this->json('GET', route('api.admin.system.dispatcher'));

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertNotEmpty($data->dispatchers);
        $this->paginationTest($data->dispatchers);

    }

    /**
     * @test
     */
    public function canAdminStoreNewDispatcher()
    {
        $this->asAdmin();

        $name = $this->getRandomUniqueData('dispatchers', 'name', 'word');
        $code = $this->getRandomUniqueData('dispatchers', 'name', 'word');

        $response = $this->json('POST', route('api.admin.system.dispatcher.store'), [
            'name' => $name,
            'code' => $code,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.dispatcher.success.store'),
                'dispatcher' => [
                    'name' => $name,
                    'code' => $code,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminUpdateDispatcher()
    {
        $this->asAdmin();

        // Find random client
        $dispatcher = $this->findRandomData('dispatchers');
        $name = $dispatcher->name;

        $newName = $this->getRandomUniqueData('dispatchers', 'name', 'word');

        $response = $this->json('POST', route('api.admin.system.dispatcher.update', ['name' => $name]), [
            'id' => $dispatcher->id,
            'name' => $newName,
            'code' => $dispatcher->code,
        ]);

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.dispatcher.success.update', ['name' => $name]),
                'dispatcher' => [
                    'id' => $dispatcher->id,
                    'code' => $dispatcher->code,
                    'name' => $newName,
                ],
            ]);
    }

    /**
     * @test
     */
    public function canAdminDeleteDispatcher()
    {
        $this->asAdmin();

        $dispatcher = Dispatcher::first();
        $deletedId = $dispatcher->id;
        $response = $this->json('POST', route('api.admin.system.dispatcher.destroy', ['id' => $dispatcher->id]));
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.admin.system.dispatcher.success.destroy'),
            ]);
        $this->assertNull(Dispatcher::find($deletedId));
    }
}
