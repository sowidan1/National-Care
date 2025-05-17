<?php

namespace App\Http\Services\Services;

use App\Http\Requests\ProductRequest;
use App\Http\Services\Contracts\ProductContract;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductService implements ProductContract
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // Handle file upload if needed
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/images', 'public');
        }

        try {
            Product::create([
                'id' => Str::ulid(),
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image_url' => $imagePath,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create product: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        // Handle file upload if needed
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/images', 'public');
        }

        try {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image_url' => $imagePath,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
