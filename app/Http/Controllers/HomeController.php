<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(12);

        $products->getCollection()->transform(function ($product) {
            if ($product->image_url && ! filter_var($product->image_url, FILTER_VALIDATE_URL)) {
                $product->image_url = asset(path: 'storage/'.$product->image_url);
            }

            return $product;
        });

        return view('welcome', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function orderConfirmation()
    {
        return view('order-confirmation');
    }
}
