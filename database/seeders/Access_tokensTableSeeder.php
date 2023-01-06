<?php

namespace Database\Seeders;

use App\Models\Access_token;
use Illuminate\Database\Seeder;

class Access_tokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Access_token::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few User_statuss in our database:
        for ($i = 0; $i < 3; $i++) {
            Access_token::create([
                // 'status' => $faker->name,
                'token' => 1234,
            ]);
        }
    }
}
