<?php

namespace App\Traits;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

trait GeneratePdfTrait 
{
    public function generatePDF(Sale $sale)
    {
  
        $sale = Sale::with('user')->findOrFail($sale->id);
        $user = $sale->user;
        $pdf = Pdf::loadView('pdf.invoice', compact('sale', 'user'));
    
        $pdf->save(storage_path("app/public/sales/invoice_{$sale->id}.pdf"));
        return $pdf->stream('invoice_{$sale->id}.pdf');
    }
}