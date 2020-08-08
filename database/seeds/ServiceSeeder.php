<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
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
            $service = new App\Service;
            $service->service_type = $faker->text(30);
            $service->save();
        }
    }
}
