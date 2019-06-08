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
        $response = $this->json('GET', route('api.client.patient'));
        $data = $response->getData();
        $response
            ->assertStatus(self::RESPONSE_SUCCESS)
            ->assertJson([
                'success' => true,
                'message' => '',
            ]);

        $this->assertObjectHasAttribute('patients', $data);
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
                    'hmo_card_no' => null,
                ],
            ]);
    }
}
