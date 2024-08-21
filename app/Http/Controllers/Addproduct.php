<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class Addproduct extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $username= $request->user()->name;
        $products=Product::where('creadt_at',$username)->select('image','name','company')->get();
        return view('products.Addprod',compact('products'));
    }
    public function create(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');
        
        $product = new Product;
        $product->fill($request->only('name','company'));
        $product->image = $imagePath;
        $product->creadt_at = auth()->user()->email;
        if($product->save()){
            return redirect('/products')->with('success', 'Product added successfully.');
        }
        abort(401);
        // Product::create([
        //     'image' => $imagePath,
        //     'name' => $request->name,
        //     'company' => $request->company,
        //     'creadt_at' => Auth::user()->name,
        // ])->save();

        

    }
}
