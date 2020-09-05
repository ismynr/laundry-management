<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $idUserSuffle = App\User::whereRaw('(id NOT LIKE 1)')->pluck('id')->toArray();

        for ($i=0; $i < 15; $i++) { 
            $karyawan = new App\Karyawan;
            $karyawan->id_user   = $faker->unique()->randomElement($idUserSuffle);
            $karyawan->alamat    = $faker->address();
            $karyawan->telephone = $faker->numerify('08##########');
            $karyawan->gender    = $faker->randomElement(['laki-laki', 'perempuan']);
            $karyawan->save();
        }

    }
}
