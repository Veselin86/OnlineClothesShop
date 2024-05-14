<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Product;
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
    public function storeApiSell(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'size' => 'string',
            'color' => 'string',
        ]);

        $productID = $request->product_id;
        $productData = $this->fetchDataApi("https://fakestoreapi.com/products/{$productID}");

        if (!$productData) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

/*         $newProductID = (int) ($productData->id + 1000);
 */        
        $product = Product::firstOrCreate(
            ['name' => $productData->title],
            [   
                'name' => $productData->title,
                'description' => $productData->description,
                'price' => $productData->price,
                'stock' => $productData->rating->count,
                'image' => $productData->image,
                'provider_id' => random_int(1, 3),
                'category_id' => random_int(1, 4)
            ]
        );
        
        $userAddress = auth()->user()->addresses->first();

        if (!$userAddress) {
            return redirect()->route('dashboard')->with('error', 'Necesita añadir una dirección antes de realizar una compra.');
        }

        $sale = Sale::create([
            'user_id' => auth()->id(), 
            'status' => 'completed',
            'date' => now(),
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
