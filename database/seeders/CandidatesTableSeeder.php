<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Candidate::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 15; $i++) {
            Candidate::create([
                'name' => $faker->name,
            ]);
        }
    }
}
