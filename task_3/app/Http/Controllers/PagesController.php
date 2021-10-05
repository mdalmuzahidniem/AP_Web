<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class PagesController extends Controller
{
    //
    public function create(){
        return view('Create');
    }
    public function createSubmit(Request $request){

        $validate=$request->validate([
            'name'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'description'=>'required',
        ]);
        $var = new Product();
        $var->name = $request->name;
        $var->price = $request->price;
        $var->quantity = $request->quantity;
        $var->description = $request->description;
        $var->save();
        
        return redirect()->route('create');
    }
    public function view(){
        $products=Product::all();
        return view('View')->with('products',$products);
    }
    public function edit(Request $request){
       $id= $request->id;
        $product=Product::where('id',$id)->first();
        return view('Edit')->with('product',$product);
    }
    public function editSubmit(Request $request){
        $validate=$request->validate([
            'name'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'description'=>'required',
        ]);
        
        $id = $request->id;
        $var = Product::where('id',$id)->first();
        $var->name= $request->name;
        $var->price = $request->price;
        $var->quantity = $request->quantity;
        $var->description=$request->description;
        $var->save();
        
        return redirect()->route('view');
    }
    public function delete(Request $request){
        $id = $request->id;
        $var = product::where('id', $id)->first();
        $var->delete();
        return redirect()->route('view');
    }
}
