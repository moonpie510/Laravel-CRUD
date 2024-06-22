<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::available()->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Product::create($data);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Product $product, UpdateRequest $request)
    {
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
