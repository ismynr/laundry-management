<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(KaryawanSeeder::class);
        $this->call(ExpanseSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(TransactionDetailSeeder::class);
    }
}
