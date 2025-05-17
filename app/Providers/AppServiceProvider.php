<?php

namespace App\Providers;

use App\Events\ProductChanged;
use App\Listeners\LogProductChange;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('OrderService', function () {
            return new \App\Http\Services\Services\OrderService;
        });

        $this->app->bind('ProductService', function () {
            return new \App\Http\Services\Services\ProductService;
        });

        $this->app->bind('UserService', function () {
            return new \App\Http\Services\Services\CategoryService;
        });
    }

    public function boot(): void
    {
        Event::listen(
            ProductChanged::class,
            LogProductChange::class,
        );
    }
}
