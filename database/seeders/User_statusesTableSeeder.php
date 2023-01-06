<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User_status;

class User_statusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        User_status::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few User_statuss in our database:
        for ($i = 0; $i < 3; $i++) {
            User_status::create([
                // 'status' => $faker->name,
                'status' => 'status',
            ]);
        }
    }
}
