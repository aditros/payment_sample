<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'total_product' => 'required|numeric',
            'token' => 'required|string',
        ]);

        $token = $validatedData['token'];
        $user = User::where('api_token', $token)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid token']);
        }

        $valid_customer = $user->customers->contains($validatedData['customer_id']);
        if (!$valid_customer) {
            return response()->json(['success' => false, 'message' => 'Invalid customer']);
        }

        $total_payment = $validatedData['total_product'] * $user->products->find($validatedData['product_id'])->price;
        $validatedData['total_payment'] = $total_payment;
        $payment_date = date('Y-m-d');
        $validatedData['payment_date'] = $payment_date;

        $valid_product = $user->products->contains($validatedData['product_id']);
        if (!$valid_product) {
            return response()->json(['success' => false, 'message' => 'Invalid product']);
        }

        $payment = Payment::create($validatedData);

        return response()->json(['success' => true, 'payment' => $payment]);
    }
}