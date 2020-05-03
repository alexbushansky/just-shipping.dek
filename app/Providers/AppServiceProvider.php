<?php

namespace App\Providers;

use App\Models\Dialog;
use App\Observers\DialogOfferObserver;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use App\Services\CustomerOfferService;
use App\Services\DialogService;
use App\Services\DriverCarService;
use App\Services\DriverOfferService;
use App\Services\Interfaces\CustomerOfferServiceInterface;
use App\Services\Interfaces\DialogServiceInterface;
use App\Services\Interfaces\DriverCarServiceInterface;
use App\Services\Interfaces\DriverOfferServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

        private $roles;



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DriverCarServiceInterface::class, DriverCarService::class);
        $this->app->bind(CustomerOfferServiceInterface::class, CustomerOfferService::class);
        $this->app->bind(DriverOfferServiceInterface::class, DriverOfferService::class);
        $this->app->bind(DriverOfferServiceInterface::class, DriverOfferService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(DialogServiceInterface::class, DialogService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Dialog::observe(DialogOfferObserver::class);
    }


}
