<?php

namespace Database\Seeders;

use App\Models\Access_token;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            UsersTableSeeder::class,
            User_statusesTableSeeder::class,
            ClientsTableSeeder::class,
            ApisTableSeeder::class,
            TimesheetsTableSeeder::class
        ]);
    }
}
