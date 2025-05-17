<?php

namespace App\Http\Services\Contracts;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

interface CategoryContract
{
    public function store(CategoryRequest $request);

    public function index(Request $request);

    public function update(CategoryRequest $request, $id);

    public function destroy($id);
}
