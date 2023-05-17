<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index(){
        $product=Product::paginate(5);
        return view('product.index',compact('product'));
    }

    public function create(){
        return view('product.create');

    }
    public function show(Request $request){




         $product=Product::create($request->all());





         return redirect('/product')->with('message','Product Added Successfully');

    }

    public function edit($productId){
        $product=Product::findOrFail($productId);

        return view('product.edit',compact('product'));

    }

    public function update(Request $request, Product $productId){

        $productData= $request->validate([

            'name'=>'required|string',
            'description'=>'required',
            'price'=>'integer|required',
        ]);


        // $product=Product::findOrFail($productId);
        $productId->update($productData);


            // $product->addMedia($validatedData->image[0])->toMediaCollection('product_image');

            return redirect('/product')->with('message','Product Updated Successfully');

    }

    public function delete(Product $productId){
        // $product=Product::findOrFail($productId)->delete();
        // return redirect('/product')->with('message','Product Deleted Successfully');
        if($productId){


            $productId->delete();
            return redirect('/product')->with('message','Product Deleted Successfully');
        }
        else{
            return redirect('/product')->with('message','Something Went Wrong! ');

        }

    }


}
