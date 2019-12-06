<?php

namespace App\Providers;

use App\Services\Interfaces\MessageServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\MessageService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(MessageServiceInterface::class, MessageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
