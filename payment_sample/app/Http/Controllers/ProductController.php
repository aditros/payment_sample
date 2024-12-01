<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->user()->products;
        return view('product.index', ['products' => $products]);
    }

    public function createIndex(Request $request)
    {
        return view('product.create');
    }

    public function createPost(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->user_id = $request->user()->id;
        $product->save();
        return redirect()->route('product.edit.index', ['id' => $product->id]);
    }

    public function editIndex(Request $request, int $id)
    {
        $product = Product::find($id);
        return view('product.create', ['product' => $product]);
    }

    public function editPatch(Request $request, int $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('product.edit.index', ['id' => $product->id]);
    }

    public function delete(Request $request, int $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product');
    }

    public function restAllProducts(Request $request)
    {
        $api_token = $request->get('token', '');
        $user = User::where('api_token', $api_token)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid token']);
        }

        $products = $user->products;
        return response()->json(['success' => true, 'products' => $products]);
    }

    public function restProduct(Request $request, int $id)
    {
        $api_token = $request->get('token', '');
        $user = User::where('api_token', $api_token)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid token']);
        }

        $product = $user->products->find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Invalid product']);
        }

        return response()->json(['success' => true, 'product' => $product]);
    }
}
