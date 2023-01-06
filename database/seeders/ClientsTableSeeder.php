<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Client::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few Clients in our database:
        for ($i = 0; $i < 5; $i++) {
            Client::create([
                'name' => $faker->name,
            ]);
        }
    }
}
