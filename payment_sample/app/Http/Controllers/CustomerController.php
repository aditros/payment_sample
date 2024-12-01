<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

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

    public function restAllCustomers(Request $request)
    {
        $api_token = $request->get('token', '');
        $user = User::where('api_token', $api_token)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid token']);
        }
        $customers = $user->customers;
        return response()->json(['success' => true, 'customers' => $customers]);
    }

    public function restCustomer(Request $request, int $id)
    {
        $api_token = $request->get('token', '');
        $user = User::where('api_token', $api_token)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid token']);
        }
        $customer = $user->customers->find($id);
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Invalid customer']);
        }
        return response()->json(['success' => true, 'customer' => $customer]);
    }
}
