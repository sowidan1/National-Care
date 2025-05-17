<?php

namespace App\Http\Services\Facades;

use App\Http\Services\Services\OrderService;
use Illuminate\Support\Facades\Facade;

class OrderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OrderService::class;
    }
}
