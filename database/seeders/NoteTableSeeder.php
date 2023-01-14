<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::truncate();

        $faker = \Faker\Factory::create();
        $noteable = [
            User::class,
            Client::class,
        ];
        for ($i = 0; $i < 50; $i++) {
            Note::create([
                // 'client_id' => Client::all()->random()->id,
                'title' => $faker->text(13),
                'content' => $faker->paragraph,
                'noteable_id' => $faker->randomDigitNotNull(),
                'noteable_type' => $faker->randomElement($noteable),

            ]);
        }
    }
}
