<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Timesheet;

class TimesheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Timesheet::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few Timesheets in our database:
        for ($i = 0; $i < 5; $i++) {
            Timesheet::create([
                // 'name' => $faker->name,
            ]);
        }
    }
}
