<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('no.cache');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form
        $this->validate($request, [
            'name'        => 'required|min:3|unique:categories',
            'description' => 'required|min:10'
        ]);

        // Create category
        Category::create([
            'name'        => $request->name,
            'description' => $request->description
        ]);

        // Redirect to index
        return redirect(route('daftarCategory'))->with('success', 'Category successfully created');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Category $category)
    // {
    //     return view('categories.show', [
    //         'category' => $category,
    //         'products' => $category->products
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate form
        $this->validate($request, [
            'name'        => 'required|min:3|unique:categories,name,' . $id,
            'description' => 'required|min:10'
        ]);

        // Get category by ID
        $category = Category::findOrFail($id);

        // Update category
        $category->update([
            'name'        => $request->name,
            'description' => $request->description
        ]);

        // Redirect to index
        return redirect(route('daftarCategory'))->with('success', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect(route('daftarCategory'))->with('success', 'Category successfully deleted');
    }
}
