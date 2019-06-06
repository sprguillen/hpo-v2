<?php

namespace Tests\Api\Client;

use Tests\TestCase;
use App\Models\User;
use App\Models\ClientStaff;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientStaffTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function canGetClientStaffs()
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
        $this->assertNotEmpty($data->staffs);
        $this->paginationTest($data->staffs);

        // Check on database if results match
        $clientDatabaseResult = ClientStaff::where('client_id', $this->user->id)->count();
        $this->assertEquals($data->staffs->total, $clientDatabaseResult);
    }

    /**
     * @test
     */
    public function canStoreClientOnService()
    {
        $this->asClient();

        $email = $this->faker->email;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $username = $firstName . $lastName;

        $response = $this->json('POST', route('api.client.staff.store'), [
            'email' => $email,
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);
        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.client.staff.success.store'),
                'staff' => [
                    'client_id' => $this->user->id,
                    'user' => [
                        'email' => $email,
                        'username' => $username,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                    ]
                ],
            ]);

        $this->assertObjectHasAttribute('staff', $data);
        $staff = $data->staff;
        // Check if staff is already have `user` data
        $this->assertObjectHasAttribute('user', $staff);
    }

    /**
     * @test
     */
    public function canGetClientStaffsWithUserDataOnStaff()
    {
        // Get client who has staff
        $clientWithStaff = ClientStaff::with('client')->orderByRaw('RAND()')->first();
        if ($clientWithStaff) {
            $this->asClient($clientWithStaff->client->email);
            $response = $this->json('GET', route('api.client.staff'));
            $data = $response->getData();
            $response
                ->assertStatus(self::RESPONSE_SUCCESS)
                ->assertJson([
                    'success' => true,
                    'message' => '',
                ]);

            $staffs = $data->staffs;

            $this->assertObjectHasAttribute('staffs', $data);
            $this->assertNotEmpty($staffs);
            $this->paginationTest($staffs);

            $staff = $staffs->data[0];
            $this->assertObjectHasAttribute('user', $staff);
        } else {
            $this->assertEmpty($clientWithStaff);
        }
    }

    /**
     * @test
     */
    public function canUpdateClientStaffFirstOrLastName()
    {
        // Get client who has staff
        $clientWithStaff = ClientStaff::with('client')->orderByRaw('RAND()')->first();
        if ($clientWithStaff) {

            $firstName = $this->faker->firstName;
            $lastName = $this->faker->lastName;

            $oldStaffData = User::find($clientWithStaff->staff_id);
            $oldFirstName = $oldStaffData->first_name;
            $oldLastName = $oldStaffData->last_name;

            $this->asClient($clientWithStaff->client->email);

            $response = $this->json('POST', route('api.client.staff.update', ['id' => $clientWithStaff->id]), [
                'id' => $clientWithStaff->id,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
            $data = $response->getData();

            $response
                ->assertStatus(self::RESPONSE_SUCCESS)
                ->assertJson([
                    'success' => true,
                    'message' => trans('message.client.staff.success.update'),
                    'staff' => [
                        'id' => $clientWithStaff->id,
                        'client_id' => $this->user->id,
                        'staff_id' => $clientWithStaff->staff_id,
                        'user' => [
                            'id' => $clientWithStaff->staff_id,
                            'first_name' => $firstName,
                            'last_name' => $lastName,
                        ]
                    ],
                ]);
        } else {
            $this->assertEmpty($clientWithStaff);
        }
    }

    /**
     * @test
     */
    public function clientCanArchiveStaff()
    {
        // Get client who has staff
        $clientWithStaff = ClientStaff::with('client')->orderByRaw('RAND()')->first();
        if ($clientWithStaff) {

            $this->asClient($clientWithStaff->client->email);

            $response = $this->json('POST', route('api.client.staff.archive', ['id' => $clientWithStaff->id]));
            $data = $response->getData();

            $response
                ->assertStatus(self::RESPONSE_SUCCESS)
                ->assertJson([
                    'success' => true,
                    'message' => trans('message.client.staff.success.archive'),
                ]);
        } else {
            $this->assertEmpty($clientWithStaff);
        }
    }

    /**
     * @test
     */
    public function clientCanSearchOnHisStaffs()
    {
        // Get client who has staff
        $clientWithStaff = ClientStaff::with('client')->orderByRaw('RAND()')->first();
        if ($clientWithStaff) {

            $this->asClient($clientWithStaff->client->email);

            // Search from database - find firstname
            $randomUser = User::find($clientWithStaff->staff_id);
            $key = substr($randomUser->first_name, 0, 3);

            $response = $this->json('GET', route('api.client.staff.search', ['key' => $key]));
            $data = $response->getData();

            $response
                ->assertStatus(self::RESPONSE_SUCCESS)
                ->assertJson([
                    'success' => true,
                ]);

            // Test results
            $this->assertObjectHasAttribute('staffs', $data);

        } else {
            $this->assertEmpty($clientWithStaff);
        }
    }
}
