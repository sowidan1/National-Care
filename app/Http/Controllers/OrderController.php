<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Services\Facades\OrderFacade;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {

        return OrderFacade::store($request);
    }

    public function index(Request $request)
    {
        return OrderFacade::index($request);
    }
}
