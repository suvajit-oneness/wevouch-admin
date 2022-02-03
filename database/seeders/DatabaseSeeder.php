<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $faker = Faker::create();

    	foreach (range(1,5) as $index) {
            DB::table('borrowers')->insert([
                'name_prefix' => $faker->title,
                'full_name' => $faker->name,
                'gender' => $faker->randomElement(['male', 'female']),
                'email' => $faker->unique()->safeEmail(),
                'mobile' => $faker->randomELement([9,8,7]).$faker->numberBetween(100000000, 999999999),
                // 'mobile' => $faker->phoneNumber,
                'agreement_id' => $faker->randomElement([0, 1]),
                'occupation' => $faker->company,
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'marital_status' => $faker->randomElement(['married', 'unmarried', 'divorced', 'widowed']),
                'image_path' => 'admin/dist/img/generic-user-icon.png',
                'signature_path' => '',
                'street_address' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => $faker->state,
                'block' => $faker->randomElement([0, 1]),
            ]);
        }
    }
}
