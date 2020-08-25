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
