<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        
        return view('user.user');
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'current_password' => ['required', 'string', 'min:8'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('image')) {
        if ($user->image && Storage::exists($user->image)) {
            Storage::delete($user->image);
        }

        $imagePath = $request->file('image')->store('images', 'public');
        $user->image = $imagePath;
    }

    $user->save();

    return redirect('/userp');
}

}
