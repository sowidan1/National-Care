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
        //
    }

    public function boot(): void
    {
        Event::listen(
            ProductChanged::class,
            LogProductChange::class,
        );
    }
}
