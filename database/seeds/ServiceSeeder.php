<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1; $i < 5; $i++) {
            $source = new Services();
            $source->code = int_to_code($i);
            $source->name = $faker->bs;
            $source->default_cost = $faker->numberBetween(100, 10000);;
            $source->save();
        }
    }
}
