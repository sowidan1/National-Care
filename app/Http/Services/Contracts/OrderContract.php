<?php

namespace App\Http\Services\Contracts;

use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;

interface OrderContract
{
    public function store(OrderStoreRequest $request);

    public function index(Request $request);
}
