<?php

namespace Tests\Api\Client;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientPatientTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetClientPatients()
    {
        $this->asClient();
        $response = $this->json('GET', route('api.client.staff'));
        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertObjectHasAttribute('staffs', $data);
    }

    /**
     * @test
     */
    public function cannotRequestOnClientRoutesIfUserIsNotAClient()
    {
        // User is not client
        $this->asProcessor();

        $response = $this->json('GET', route('api.client.staff'));
        $response
            ->assertStatus(self::RESPONSE_REDIRECTION);
    }
}
