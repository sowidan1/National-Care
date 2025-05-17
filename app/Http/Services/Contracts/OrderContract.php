<?php

namespace App\Http\Services\Contracts;

use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;

interface OrderContract
{
    public function store(OrderStoreRequest $request);

    public function index(Request $request);
}
