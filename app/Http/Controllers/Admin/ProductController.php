<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Http\Services\Facades\ProductFacade;

class ProductController
{
    public function index()
    {
        return ProductFacade::index();
    }

    public function create()
    {
        return ProductFacade::create();
    }

    public function store(ProductRequest $request)
    {
        return ProductFacade::store($request);
    }

    public function edit($id)
    {
        return ProductFacade::edit($id);
    }

    public function update(ProductRequest $request, $id)
    {
        return ProductFacade::update($request, $id);
    }

    public function destroy($id)
    {
        return ProductFacade::destroy($id);
    }
}
