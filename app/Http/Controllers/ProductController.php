<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.addproduct',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   try {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10248',
        ]);

        if (!$request->file('image')->isValid()) {
            return redirect()->back()->with('error', 'Invalid image file');
        }
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->save();
        return redirect()->back()->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Error adding product: ' . $e->getMessage());
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $product = Product::all();
        if ($product) {
            return response()->json($product);
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('admin.products.editproduct', compact('product'));
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10248',
        ]);

        $product = Product::find($id);
        if ($product) {
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $product->image = $imageName;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->save();
            return redirect()->back()->with('success', 'Product updated successfully');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }
}
