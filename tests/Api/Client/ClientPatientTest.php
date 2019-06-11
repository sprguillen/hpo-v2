<?php

namespace Tests\Api\Client;

use DB;
use Tests\TestCase;
use \Carbon\Carbon;
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
        $response = $this->json('GET', route('api.client.patient'));
        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertObjectHasAttribute('patients', $data);
        $this->paginationTest($data->patients);

        // Check all patients are owned by the logged in client
        foreach ($data->patients->data as $key => $patient) {
            $this->assertEquals($patient->client_id, $this->user->id);
        }
    }

    /**
     * @test
     */
    public function canStoreClientPatient()
    {
        $this->asClient();

        $email = $this->faker->email;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $gender = $this->faker->randomElement(['male', 'female']);
        $birth_date = $this->faker->date('m-d-Y');
        $passport = $this->faker->ean13;
        $citizen = 'Pilipino';
        $blood_type = $this->faker->randomElement(['O', 'A', 'B', 'AB']);
        $address = $this->faker->address;
        $city = $this->faker->city;
        $senior_citizen_id = $this->faker->ean13;
        $telephone_number = $this->faker->tollFreePhoneNumber;
        $occupation = $this->faker->jobTitle;

        $response = $this->json('POST', route('api.client.patient.store'), [
            'client_id' => $this->user->id,
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $gender,
            'birth_date' => $birth_date,
            'passport_number' => $passport,
            'citizen' => $citizen,
            'blood_type' => $blood_type,
            'address' => $address,
            'city' => $city,
            'senior_citizen_id' => $senior_citizen_id,
            'telephone_number' => $telephone_number,
            'occupation' => $occupation,
        ]);

        $data = $response->getData();

        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.client.patient.success.store'),
                'patient' => [
                    'client_id' => $this->user->id,
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
        // Get random client patient
        $patient = Patient::with('client')->orderByRaw('RAND()')->first();
        if ($patient) {
            $client = $patient->client;
            $this->asClient($client->email);

            $newFirstName = $this->faker->firstName;
            $newLastName = $this->faker->lastName;

            $response = $this->json('POST', route('api.client.patient.update', ['id' => $patient->id]), [
                'id' => $patient->id,
                'client_id' => $this->user->id,
                'email' => $patient->email,
                'first_name' => $newFirstName,
                'last_name' => $newLastName,
                'gender' => $patient->gender,
                'birth_date' => Carbon::parse($patient->birth_date)->format('m-d-Y'),
                'passport_number' => $patient->passport_number,
                'citizen' => $patient->citizen,
                'blood_type' => $patient->blood_type,
                'address' => $patient->address,
                'city' => $patient->city,
                'senior_citizen_id' => $patient->senior_citizen_id,
                'telephone_number' => $patient->telephone_number,
                'occupation' => $patient->occupation,
            ]);

            $data = $response->getData();

            $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.client.patient.success.update'),
                'patient' => [
                    'id' => $patient->id,
                    'client_id' => $this->user->id,
                    'email' => $patient->email,
                    'first_name' => $newFirstName,
                    'last_name' => $newLastName,
                ],
            ]);
        } else {
            $this->assertEmpty($patient);
        }
    }

    /**
     * @test
     */
    public function cannotUpdatePatientIfClientIsNotTheOwnerOrTheCLientPatient()
    {
        // Get random client patient
        $patient = Patient::with('client')->orderByRaw('RAND()')->first();
        if ($patient) {
            // Make sure client is not the owner of the patient
            $client = User::whereNotIn('id', [$patient->client->id])->client()->first();
            $this->asClient($client->email);

            $newFirstName = $this->faker->firstName;
            $newLastName = $this->faker->lastName;

            $response = $this->json('POST', route('api.client.patient.update', ['id' => $patient->id]), [
                'id' => $patient->id,
                'client_id' => $this->user->id,
                'email' => $patient->email,
                'first_name' => $newFirstName,
                'last_name' => $newLastName,
                'gender' => $patient->gender,
                'birth_date' => Carbon::parse($patient->birth_date)->format('m-d-Y'),
                'passport_number' => $patient->passport_number,
                'citizen' => $patient->citizen,
                'blood_type' => $patient->blood_type,
                'address' => $patient->address,
                'city' => $patient->city,
                'senior_citizen_id' => $patient->senior_citizen_id,
                'telephone_number' => $patient->telephone_number,
                'occupation' => $patient->occupation,
            ]);

            $data = $response->getData();

            $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('validation.error'),
                'errors' => [
                    'client_id' => [
                        trans('message.client.patient.error.patient_not_owned')
                    ]
                ]
            ])
            ->assertJsonValidationErrors(['client_id']);
        } else {
            $this->assertEmpty($patient);
        }
    }

    /**
     * @test
     */
    public function canArchivePatient()
    {
        // Get random client patient
        $patient = Patient::with('client')->orderByRaw('RAND()')->first();
        if ($patient) {
            $client = $patient->client;
            $this->asClient($client->email);

            $response = $this->json('POST', route('api.client.patient.archive', ['id' => $patient->id]), [
                'id' => $patient->id,
            ]);

            $data = $response->getData();
            $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => trans('message.client.patient.success.archive'),
            ]);

            // Check on database that patient is `present` but `deleted_at` column is filled
            // Only patient is archived
            $archivePatient = Patient::withTrashed()->find($patient->id);
            $this->assertTrue($archivePatient->trashed());
            
        } else {
            $this->assertEmpty($patient);
        }
    }

    /**
     * @test
     */
    public function cannotArchivePatientIfClientIsNotTheOwner()
    {
        // Get random client patient
        $patient = Patient::with('client')->orderByRaw('RAND()')->first();
        if ($patient) {
            // Make sure client is not the owner of the patient
            $client = User::whereNotIn('id', [$patient->client->id])->client()->first();
            $this->asClient($client->email);

            $response = $this->json('POST', route('api.client.patient.archive', ['id' => $patient->id]), [
                'id' => $patient->id,
            ]);

            $data = $response->getData();
            $response
            ->assertStatus(self::RESPONSE_CLIENT_ERROR)
            ->assertJson([
                'success' => false,
                'message' => trans('message.client.patient.error.patient_not_owned'),
            ]);
        } else {
            $this->assertEmpty($patient);
        }
    }

    /**
     * @test
     */
    public function canSearchOnClientPatient()
    {
        // Get random client patient - and get it's name
        $patient = Patient::with('client')->orderByRaw('RAND()')->first();
        if ($patient) {
            $client = $patient->client;
            $this->asClient($client->email);

            $key = substr($patient->first_name, 0, 3);

            $response = $this->json('GET', route('api.client.patient.search', ['key' => $key]), [
                'id' => $patient->id,
            ]);

            $data = $response->getData();

            $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

            $this->assertObjectHasAttribute('patients', $data);

            // Check all patients are owned by the logged in client
            foreach ($data->patients->data as $key => $patient) {
                $this->assertEquals($patient->client_id, $this->user->id);
            }

        } else {
            $this->assertEmpty($patient);
        }
    }
}
