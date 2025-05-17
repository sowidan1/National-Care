<?php

namespace App\Providers;

use App\Events\ProductChanged;
use App\Listeners\LogProductChange;
use App\Services\Services\OrderService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('OrderService', function () {
            return new OrderService;
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
