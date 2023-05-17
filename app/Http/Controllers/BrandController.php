<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $product=Brand::paginate(5);
        return view('brand.index',compact('product'));
    }

    public function create(){
        return view('brand.create');

    }
    public function show(Request $request){
        Brand::create($request->all());
        return redirect('/brand')->with('message','Product Added Successfully');
    }
}
