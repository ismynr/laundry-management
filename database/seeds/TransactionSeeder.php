<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
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
        $idCustomerSuffle = App\Customer::all()->pluck('id')->toArray();

        for ($i=0; $i < 25; $i++) { 
            $trans = new App\Transaction;
            $trans->id_user     = $faker->randomElement($idUserSuffle);
            $trans->id_customer = $faker->randomElement($idCustomerSuffle);
            $trans->code        = $faker->unique()->numerify('TR-00000000#######');
            $trans->total_harga = $faker->numberBetween($min = 1000, $max = 10000000);
            $trans->start_date  = $faker->dateTimeAD($max = 'now', $timezone = null);
            $trans->end_date    = $faker->dateTimeAD($max = 'now', $timezone = null);
            $trans->save();
        }
    }
}
