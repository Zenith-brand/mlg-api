<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;

class ApisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Api::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few User_statuss in our database:
        for ($i = 0; $i < 3; $i++) {
            Api::create([
                'token' => 1234,
                'key' => "qwe",
                'url' => "127.0.0.1",
            ]);
        }
    }
}
