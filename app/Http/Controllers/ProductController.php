<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json(['product'=>$product],200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product)
        {
            return response()->json(['product'=>$product],200);
        }
        else
        {
            return response()->json(['message'=>' No Product Found'],404);
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:191',
            'description'=>'required|max:191',
            'price'=>'required|max:191',
            'qty'=>'required|max:191'
        ]);

        $product = new Product;
        $product->name  = $request -> name;
        $product->description  = $request -> description;
        $product->price  = $request -> price;
        $product->qty  = $request -> qty;
        $product->save();
        return response()->json(['message'=>'Product added Succesfully'],200);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|max:191',
            'description'=>'required|max:191',
            'price'=>'required|max:191',
            'qty'=>'required|max:191'
        ]);

        $product = Product::find($id);
        if($product)
        {
            $product->name  = $request -> name;
            $product->description  = $request -> description;
            $product->price  = $request -> price;
            $product->qty  = $request -> qty;
            $product->update();
            return response()->json(['message'=>'Product updated Succesfully'],200);
        }
        else
        {
            return response()->json(['message'=>' No Product Found'],404);
        }
      
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product)
        {
            $product->delete();
            return response()->json(['message'=>'Product delete Succesfully'],200);
        }
        else
        {
            return response()->json(['message'=>' No Product Found'],404);
        }
    }
}
