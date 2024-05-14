<?php

namespace App\Http\Controllers;

use App\Mail\InvoicesMailabel;
use App\Models\Address;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Traits\GeneratePdfTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SaleController extends Controller
{

    use GeneratePdfTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        /* $sales = Sale::with('products')->get(); */
        return view('sales.index', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     */
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

        $product = Product::find($request->product_id);

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

        $product->decrement('stock', $request->quantity);

        $sale->products()->attach($product->id, [
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $product->price * $request->quantity,
            'size' => $request->size,
            'color' => $request->color
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

        $this->generatePDF($sale);

        Mail::to($request->user())
            ->send(new InvoicesMailabel($sale, $request->user()));
            
        return redirect()->route('dashboard')->with('success', 'Producto comprado');
    }
}
