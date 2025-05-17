<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\Facades\CategoryFacade;
use Illuminate\Http\Request;

class CategoryController
{
    public function index(Request $request)
    {
        return CategoryFacade::index($request);
    }

    public function store(CategoryRequest $request)
    {
        return CategoryFacade::store($request);
    }

    public function update(CategoryRequest $request, $id)
    {
        return CategoryFacade::update($request, $id);
    }

    public function destroy($id)
    {
        return CategoryFacade::destroy($id);
    }
}
