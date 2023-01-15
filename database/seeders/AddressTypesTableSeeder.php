<?php

namespace Database\Seeders;

use App\Models\Address_type;
use Illuminate\Database\Seeder;

class AddressTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address_type::truncate();

        $faker = \Faker\Factory::create();
        $address_type = [
            'Home', // Home
            'Work', // Work
        ];
        for ($i = 0; $i < 1; $i++) {
            Address_type::create([
                'type' => $address_type[$i],
            ]);
        }
    }
}
