<?php

namespace App\Providers;


use App\Models\Address;
use App\Repositories\AddressRepository;
use App\Repositories\CustomerOfferRepository;
use App\Repositories\DialogRepository;
use App\Repositories\DriverCarRepository;
use App\Repositories\DriverOfferRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use App\Repositories\Interfaces\DialogRepositoryInterface;
use App\Repositories\Interfaces\DriverCarRepositoryInterface;
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
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(DriverCarRepositoryInterface::class, DriverCarRepository::class);
        $this->app->bind(DialogRepositoryInterface::class, DialogRepository::class);
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
