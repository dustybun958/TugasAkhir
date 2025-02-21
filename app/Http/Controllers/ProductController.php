<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('no.cache');
    }
    public function index()
    {
        $products = Product::all();
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999999999.99', // Menambahkan batas maksimum
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'price.min' => 'The price must be at least 0.',
            'price.max' => 'The price must not exceed 999,999,999,999.99.',
            'stock.min' => 'The stock must be at least 0.',
        ]);

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        // Create product
        Product::create([
            'category_id'  => $request->category_id,
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image_path'  => $image->hashName()
        ]);

        // Redirect to index
        return redirect(route('daftarProduct'))->with('success', 'Product successfully created');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Product $product)
    // {
    //     return view('product.show', compact('product'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = \App\Models\Category::all();
        $product = Product::findOrFail($id);
        return view('product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate form
        $this->validate($request, [
            'category_id'  => 'required|integer',
            'name'        => 'required|min:3',
            'description' => 'required|min:10',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            // Delete old image
            Storage::delete('public/products/' . $product->image_path);

            // Update product with new image
            $product->update([
                'category_id'  => $request->category_id,
                'name'        => $request->name,
                'description' => $request->description,
                'price'       => $request->price,
                'stock'       => $request->stock,
                'image_path'  => $image->hashName()
            ]);
        } else {
            // Update product without image
            $product->update([
                'category_id'  => $request->category_id,
                'name'        => $request->name,
                'description' => $request->description,
                'price'       => $request->price,
                'stock'       => $request->stock
            ]);
        }

        return redirect(route('daftarProduct'))->with('success', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/products/' . $product->image_path);
        $product->delete();
        return redirect(route('daftarProduct'))->with('success', 'Product successfully deleted');
    }
}
