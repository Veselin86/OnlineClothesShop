<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category_id = null)
    {
        if ($category_id) {
            $products = Product::where('category_id', $category_id)->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sizes' => 'required|array',
            'colors' => 'required|array',
            'image' => 'required|string',
            'provider_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        $sizes = is_string($request->sizes) ? json_decode($request->sizes, true) : $request->sizes;
        $colors = is_string($request->colors) ? json_decode($request->colors, true) : $request->colors;
        
        $product = new Product([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'sizes' => $sizes,
            'colors' => $colors,
            'image' => $validatedData['image'],
            'provider_id' => $validatedData['provider_id'],
            'category_id' => $validatedData['category_id']
        ]);

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto guardado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return view('products.show', ['product' => $product]);
    }
}
