<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) {
            $user = new User();
            $user->code = str_random(20);
            $user->global_prefix = '';
            $user->type = 'client';
            $user->username = $faker->userName;
            $user->email = $faker->freeEmail;
            $user->password = Hash::make('secret');
            $user->first_name = $faker->firstNameMale;
            $user->last_name = $faker->lastName;
            $user->contact_number = $faker->phoneNumber;
            $user->business_name = $faker->company;
            $user->business_address = $faker->address;
            $user->is_active = true;
            $user->save();
        }

        // Seed admin
        $user = new User();
        $user->code = str_random(20);
        $user->global_prefix = '';
        $user->type = 'client';
        $user->username = $faker->userName;
        $user->email = $faker->freeEmail;
        $user->password = Hash::make('secret');
        $user->first_name = $faker->firstNameMale;
        $user->last_name = $faker->lastName;
        $user->role = User::ROLE_ADMIN;
        $user->contact_number = $faker->phoneNumber;
        $user->business_name = $faker->company;
        $user->business_address = $faker->address;
        $user->is_active = true;
        $user->save();
    }
}
