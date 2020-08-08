<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $idTransSuffle = App\Transaction::all()->pluck('id')->toArray();
        $idPackSuffle = App\Package::all()->pluck('id')->toArray();

        for ($i=0; $i < 50; $i++) { 
            $transD = new App\TransactionDetail;
            $transD->id_transaction = $faker->randomElement($idTransSuffle);
            $transD->id_package     = $faker->randomElement($idPackSuffle);
            $transD->qty            = $faker->numberBetween($min = 1, $max = 3);
            $transD->harga          = $faker->numberBetween($min = 1000, $max = 10000000);
            $transD->status         = $faker->randomElement(['diterima', 'proses', 'diambil']);
            $transD->save();
        }
    }
}
