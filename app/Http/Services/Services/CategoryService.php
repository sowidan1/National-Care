<?php

namespace App\Http\Services\Services;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\Contracts\CategoryContract;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryService implements CategoryContract
{
    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'id' => Str::ulid(),
                'name' => $request->name,
            ]);

            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Failed to create category: '.$e->getMessage())->withInput();
        }
    }

    public function index(Request $request)
    {
        $categories = Category::paginate(10);
        $editCategory = null;

        if ($request->has('edit_category')) {
            $editCategory = Category::findOrFail($request->edit_category);
        }

        return view('admin.categories.index', compact('categories', 'editCategory'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update(['name' => $request->name]);

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Failed to update category: '.$e->getMessage())->withInput()->with('edit_category', $id);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->products()->exists()) {
                return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with associated products.');
            }
            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')->with('error', 'Failed to delete category: '.$e->getMessage());
        }
    }
}
