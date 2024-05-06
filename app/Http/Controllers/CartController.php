<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        $cart = session()->get('cart', []);
        
        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
        ];

        $cart[$product->id] = $cartItem;
        session()->put('cart', $cart);

        return response()->json(['message' => 'Producto añadido al carrito', 'cart' => $cart]);
    }
}
