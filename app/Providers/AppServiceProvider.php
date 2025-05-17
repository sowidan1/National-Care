<?php

namespace App\Providers;

use App\Events\ProductChanged;
use App\Listeners\LogProductChange;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(
            ProductChanged::class,
            LogProductChange::class,
        );    }
}
