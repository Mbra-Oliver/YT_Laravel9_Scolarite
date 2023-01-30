<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index');
    }

    public function create()
    {
        return view('payments.create');
    }

    public function edit(Payment $payment){
        return view('payments.edit', compact('payment'));
    }
}
