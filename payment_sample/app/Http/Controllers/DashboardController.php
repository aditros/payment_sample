<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $payments = $request->user()->payments;
        return view('dashboard', ['payments' => $payments]);
    }
}
