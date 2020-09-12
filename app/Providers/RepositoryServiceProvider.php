<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ServiceRepository;
use App\Interfaces\ServiceRepositoryInterface;
use App\Repositories\PackageRepository;
use App\Interfaces\PackageRepositoryInterface;
use App\Repositories\ExpanseRepository;
use App\Interfaces\ExpanseRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Interfaces\CustomerRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\KaryawanRepository;
use App\Interfaces\KaryawanRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Interfaces\TransactionRepositoryInterface;
use App\Repositories\TransactionDetailRepository;
use App\Interfaces\TransactionDetailRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ServiceRepositoryInterface::class, 
            ServiceRepository::class
        );

        $this->app->bind(
            PackageRepositoryInterface::class, 
            PackageRepository::class
        );

        $this->app->bind(
            ExpanseRepositoryInterface::class, 
            ExpanseRepository::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class, 
            CustomerRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class, 
            UserRepository::class
        );

        $this->app->bind(
            KaryawanRepositoryInterface::class, 
            KaryawanRepository::class
        );

        $this->app->bind(
            TransactionRepositoryInterface::class, 
            TransactionRepository::class
        );
        
        $this->app->bind(
            TransactionDetailRepositoryInterface::class, 
            TransactionDetailRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
