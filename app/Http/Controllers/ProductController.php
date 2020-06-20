<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = CategoryProduct::all();

        // $products = [];

        $categoryProducts = [];

        if (request()->category) {
            $categoryProducts = CategoryProduct::where('name', request()->category)->first();
        }

        // dd($products);

        return view('products.index', [
            'products' => request()->category ? $categoryProducts->products : $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product)
    {
        // dd($product->categoryProduct);

        return view('products.show', ['product' => $product]);
    }
}
