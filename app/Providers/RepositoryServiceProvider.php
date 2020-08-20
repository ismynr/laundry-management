<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ServiceRepository;
use App\Interfaces\ServiceRepositoryInterface;
use App\Repositories\PackageRepository;
use App\Interfaces\PackageRepositoryInterface;

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
