<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
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
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_url' => 'required',
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->image_url = $validatedData['image_url'];
        $category->save();

        return redirect()->route('categories.index')->withSucces('¡Nueva categoria creada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $id)
    {

        $category = Category::where('id', $id)->firstOrFail();
        $productsByCategory = Product::where('category', $category);
        
        return view('products.index', compact('products', $productsByCategory));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function showProducts(Category $category)
    {
        $products = $category->products;
        return view('products.index', compact('category', 'products'));
    }

    public function createProduct($categoryId)
    {
        $category = Category::findOrFail($categoryId); 
        return view('products.create', ['category' => $category]);
    }
}
