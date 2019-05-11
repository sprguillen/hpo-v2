<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Source;

class SourcesSeeder extends Seeder
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
            $source = new Source();
            $source->code = int_to_code($i);
            $source->name = $faker->company;
            $source->save();
        }
    }
}
