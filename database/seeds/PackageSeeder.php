<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $idUserSuffle = App\User::all()->pluck('id')->toArray();
        $idServiceSuffle = App\Service::all()->pluck('id')->toArray();

        for ($i=0; $i < 25; $i++) { 
            $packages = new App\Package;
            $packages->id_user    = $faker->randomElement($idUserSuffle);
            $packages->id_service = $faker->randomElement($idServiceSuffle);
            $packages->nama_paket = $faker->text(80);
            $packages->tipe_berat = $faker->randomElement(['kg', 'ons']);
            $packages->harga      = $faker->numberBetween($min = 1000, $max = 1000000);
            $packages->save();
        }
    }
}
