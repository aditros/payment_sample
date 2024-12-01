<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = $request->user()->customers;
        return view('customer.index', ['customers' => $customers]);
    }

    public function createIndex(Request $request)
    {
        return view('customer.create');
    }

    public function createPost(Request $request)
    {
        Log::debug('createPost ' . $request->user()->id);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->cc_number = $request->cc_number;
        $customer->acc_number = $request->acc_number;
        $customer->user_id = $request->user()->id;
        $customer->save();
        return redirect()->route('customer.edit.index', ['id' => $customer->id]);
    }

    public function editIndex(Request $request, int $id)
    {
        $customer = Customer::find($id);
        return view('customer.create', ['customer' => $customer]);
    }

    public function editPatch(Request $request, int $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->cc_number = $request->cc_number;
        $customer->acc_number = $request->acc_number;
        $customer->save();
        return redirect()->route('customer.edit.index', ['id' => $customer->id]);
    }

    public function delete(Request $request, int $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customer');
    }
}
