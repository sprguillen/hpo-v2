<?php

use Illuminate\Database\Seeder;
use App\Models\Dispatcher;
use Faker\Factory as Faker;

class DispatcherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $type = ['ONLINE', 'SEND', 'TEST'];
        $code = ['C', '1', '2'];

        for ($i=0; $i < 3; $i++) {
            $dispatcher = new Dispatcher();
            $dispatcher->code = $code[$i];
            $dispatcher->name = $type[$i];
            $dispatcher->save();
        }
    }
}
