<?php

use Illuminate\Database\Seeder;

class WhiteListIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\WhiteListedIp::create(['address' => '127.0.0.1']);
    }
}
