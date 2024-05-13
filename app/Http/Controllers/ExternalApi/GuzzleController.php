<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Sale;
use App\Traits\FetchApiTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GuzzleController extends Controller
{
    use FetchApiTrait;

    public function fetchCategories()
    {
        $categories = $this->fetchDataApi("https://fakestoreapi.com/products/categories");

        return view('categories.index_external', compact('categories'));

        /*         foreach ($categories as $category) {
            echo "category: $category<br>";
        } */
    }

    public function fetchProducts($category)
    {
        $products = $this->fetchDataApi("https://fakestoreapi.com/products/category/{$category}");

        return view('products.index_external', compact('products'));

        /*         foreach ($products as $product) {
            echo "producto: $product->title<br>";
        } */
    }

    public function show($id)
    {
        $product = $this->fetchDataApi("https://fakestoreapi.com/products/{$id}");
        /* echo "producto: $product->title<br>"; */
        return view('products.show_external', compact('product'));
    }

    public function create()
    {
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
            'color' => 'required|string',
        ]);

        $productID = $request->product_id;
        $product = $this->fetchDataApi("https://fakestoreapi.com/products/{$productID}");
        $product = json_decode($product);

        $userAddress = auth()->user()->addresses->first();

        if (!$userAddress) {
            return redirect()->route('dashboard')->with('error', 'Necesita añadir una dirección antes de realizar una compra.');
        }

        $sale = Sale::create([
            'user_id' => auth()->id(), 
            'status' => 'completed',
            'date' => date(now()),
            'total' => $product->price * $request->quantity
        ]);

        $sale->products()->attach($product->id, [
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $product->price * $request->quantity,
        ]);

        $newAddress = new Address([
            'addressable_id' => $sale->id,
            'addressable_type' => Sale::class,
            'line_1' => $userAddress->line_1,
            'line_2' => $userAddress->line_2,
            'city' => $userAddress->city,
            'post_code' => $userAddress->post_code,
            'country' => $userAddress->country,
        ]);

        $newAddress->save();

        return redirect()->route('dashboard')->with('success', 'Producto comprado');
    }
}
