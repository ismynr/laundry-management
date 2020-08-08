<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ExpanseSeeder extends Seeder
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

        for ($i=0; $i < 25; $i++) { 
            $expanse = new App\Expanse;
            $expanse->id_user   = $faker->randomElement($idUserSuffle);
            $expanse->deskripsi = $faker->text($maxNbChars = 300);
            $expanse->harga     = $faker->numberBetween($min = 1000, $max = 10000000);
            $expanse->catatan   = $faker->text($maxNbChars = 100);
            $expanse->save();
        }
    }
}
