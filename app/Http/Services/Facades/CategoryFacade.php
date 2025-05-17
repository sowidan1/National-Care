<?php

namespace App\Http\Services\Facades;

use App\Http\Services\Services\CategoryService;
use Illuminate\Support\Facades\Facade;

class CategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CategoryService::class;
    }
}
