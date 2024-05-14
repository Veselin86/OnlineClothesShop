<?php

namespace App\Http\Controllers;

use App\Mail\InvoicesMailabel;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  
    public function email()
    {
        return view('emails.invoiceMail');
    }

    public function sendEmail(Request $request)
    {
        $sale = Sale::find();
        $user = $request->user();

        Mail::to($request->user())->send(new InvoicesMailabel($sale, $user));
    } 
}
