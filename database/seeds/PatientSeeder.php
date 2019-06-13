<?php

use App\Models\User;
use App\Models\Patient;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 15; $i++) {
            $client = User::client()->orderByRaw('RAND()')->first();

            $patient = new Patient();
            $patient->client_id = $client->id;

            $count = \Carbon\Carbon::now()->timestamp;

            $id = global_prefix() . $count . \Carbon\Carbon::now()->timestamp;
            $patient->code = int_to_code($count);
            $patient->global_custom_id = $id;
            $patient->hpo_patient_id = $id;

            $patient->email = $faker->email;
            $patient->first_name = $faker->firstName;
            $patient->last_name = $faker->lastName;
            $patient->gender = $faker->randomElement(['male', 'female']);
            $patient->birth_date = $faker->date('m-d-Y');
            $patient->passport_number = $faker->ean13;
            $patient->citizen = 'Pilipino';
            $patient->blood_type = $faker->randomElement(['O', 'A', 'B', 'AB']);
            $patient->address = $faker->address;
            $patient->city = $faker->city;
            $patient->senior_citizen_id = $faker->ean13;
            $patient->telephone_number = $faker->tollFreePhoneNumber;
            $patient->occupation = $faker->jobTitle;
            $patient->save();
        }
    }
}
