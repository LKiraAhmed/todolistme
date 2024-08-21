<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $username= $request->user()->name;
        $products=Product::where('creadt_at',$request->user()->email)->select('id','image','name','company')->get();
        $sections = Section::where('creadt_by', $username)->select('id', 'section_name', 'description')->get();

        return view('products.products',compact('products','sections'));
    }
    public function create(Request $request){
        $request->validate([
            'image' => 'required|image',
            'name' => 'required|string',
            'company' => 'required|string',
        ]);
    
        $imagePath = $request->file('image')->store('uploads', 'public');
        
        Product::create([
            'image' => $imagePath,
            'name' => $request->name,
            'company' => $request->company,
            'creadt_at' => Auth::user()->name,
        ])->save();
    
        return redirect('/products')->with('success', 'Product added successfully.');
    }
    
    public function edit($id)
    {
        
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    public function updates(Request $request,$id)
    {
        $product = Product::find($id);
        $product->name=$request->name;
        $product->company=$request->company;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            Storage::disk('public')->delete($product->image); 
            $product->image = $imagePath; 
        }
        $product->save();
        return redirect('/products');
    }
    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        } 
        return redirect('/products');

    }

}
