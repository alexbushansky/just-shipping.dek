<?php


namespace App\Providers;


use App\Services\AvatarService;
use App\Services\FileService;
use App\Services\Interfaces\AvatarServiceInterface;
use App\Services\Interfaces\FileServiceInterface;

use Illuminate\Support\ServiceProvider;

class AvatarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AvatarServiceInterface::class, AvatarService::class);
        $this->app->bind(FileServiceInterface::class, FileService::class);
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
