<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.product-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'is_active' => 'required|sometimes',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->is_active == true ? 1 : 0,
        ]);

        Alert::success('Success', 'Product added successfully');

        return redirect('/products')->with('success', 'Product created successfully');
    }

    public function destroy(int $id)
    {
        $product = Products::find($id);

        if ($product) {           
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }

}
