<?php

namespace App\Providers;


use App\Repositories\CustomerOfferRepository;
use App\Repositories\DriverOfferRepository;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use App\Repositories\Interfaces\DriverOfferRepositoryInterface;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DriverOfferRepositoryInterface::class, DriverOfferRepository::class);
        $this->app->bind(CustomerOfferRepositoryInterface::class, CustomerOfferRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
