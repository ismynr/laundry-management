<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        
        for ($i=0; $i < 25; $i++) { 
            $user = new App\User;
            $user->name = $faker->name;
            $user->email = $faker->unique()->email;
            $user->password = $user->email;
            $user->role = 'karyawan';

            if($i == 0){
                $user->role = 'admin';
            }

            $user->save();
        }
    }
}
