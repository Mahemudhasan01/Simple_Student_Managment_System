<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Contracts\Cache\Store;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=1; $i <= 10; $i++) { 
            $user = new User();

            $user->full_name = $faker->name;
            $user->phone_number = $faker->phoneNumber;
            $user->email = $faker->email;
            $user->password = $faker->password;
            $user->confirm_password = $faker->password;
            $user->img = $faker->image();
            $user->save();
        }        
    }
}
