<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::truncate();

        $faker = \Faker\Factory::create();

        // Making the same password
        $password = '123456';
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
            'latitude' => 17.2,
            'longitude' => 24.1,
        ]);

        for ($i = 0; $i <= 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
            ]);
        }
    }
}
