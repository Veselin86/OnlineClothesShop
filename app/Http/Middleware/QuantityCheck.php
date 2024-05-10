<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\alert;

class QuantityCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $product_id = $request->route('id');
        $product = Product::find($product_id);
        $quantity = $request->input('quantity');

        if (!$product) {
            return redirect()->back()->with('error', 'El producto solicitado no existe.');
        }

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'No hay suficiente stock! Por favor modifique su compra.');
        }

        return $next($request);
    }
}
