<?php

namespace Database\Seeders;

use App\Models\Address;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Let's truncate our existing records to start from scratch.



    public function run()
    {
        Address::truncate();

        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 40; $i++) {
            Address::create([
                'address' => $faker->unique()->address()
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            DB::table('addressables')->insert(
                [
                    'address_id' => $faker-> numberBetween($min = 1, $max = 40),
                    // 'address_type_id' => $faker->numberBetween($min = 1, $max = 2),
                    'addressable_id' => $faker -> numberBetween($min = 1, $max = 10),
                    'addressable_type' => $faker-> randomElement([ 'App\Models\Client' , 'App\Models\User', 'App\Models\Candidate'])
                ]
            );
        }



    }
}
