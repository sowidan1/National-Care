<?php

namespace App\Http\Services\Contracts;

use App\Http\Requests\ProductRequest;

interface ProductContract
{
    public function index();

    public function create();

    public function store(ProductRequest $request);

    public function edit($id);

    public function update(ProductRequest $request, $id);

    public function destroy($id);
}
