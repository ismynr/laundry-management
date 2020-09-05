<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        App\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'api_token' => Str::random(80),
            'role' => 'admin',
        ]);
        
        for ($i=0; $i < 15; $i++) { 
            $user = new App\User;
            $user->name = $faker->name;
            $user->email = $faker->unique()->email;
            $user->password = $user->email;
            $user->api_token = Str::random(80);
            $user->role = 'karyawan';
            $user->save();
        }
    }
}
