<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Product;
class ProupdateController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function edit($id)
    {
        
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    public function updates(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            
            Storage::disk('public')->delete($product->image);
    
            $product->update(['image' => $imagePath]);
        }
    
        $product->update([
            'name' => $request->input('name'),
            'company' => $request->input('company'),
        ]);
    
        return redirect('/products')->with('success', 'تم تحديث المنتج بنجاح.');
    }
    
        public function delete(Request $request, $id)
        {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return redirect('/products')->with('success', 'تم حذف المنتج بنجاح.');
            } else {
                return redirect('/products')->with('error', 'خطأ في حذف المنتج.');
            }
        }
}


