<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
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
            $customer = new App\Customer;
            $customer->alamat    = $faker->address;
            $customer->telephone = $faker->numerify('08##########');
            $customer->gender    = $faker->randomElement(['laki-laki','perempuan']);
            $customer->point     = 0;
            $customer->save();
        }
    }
}
