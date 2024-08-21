<?php
use App\Http\Controllers\Addproduct;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ADDCART;
use App\Http\Controllers\UserController;

use App\Http\Controllers\SigninController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/edit-product', [ADDCART::class,'index'])->name('add-cart.index');

// Route::get('/edit-product/{id}', [ADDCART::class,'show'])->name('product.show');

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/section', [SectionController::class,'index']);
Route::post('/section', [SectionController::class,'store'])->name('section.store');
Route::patch('/section', [SectionController::class, 'update'])->name('section.update');
Route::delete('/section',[SectionController::class,'delete'])->name('section.delete');
Route::get('/search', [SectionController::class,'search'])->name('section.search');

Route::get('/products', [ProductController::class,'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'create'])->name('products.create');

Route::get('/editsproduct/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/editsproduct/{id}', [ProductController::class, 'updates'])->name('products.update');

Route::get('/add-product', [Addproduct::class,'index'])->name('add-product.index');
Route::post('/add-product', [Addproduct::class, 'create'])->name('add-product.create');

Route::get('/userp', [UserController::class, 'index'])->name('userprofile');

Route::put('/userp', [UserController::class, 'update'])->name('user.profile.update');


Route::get('/{page}', [AdminController::class, 'index']);

Route::get('/signup', [SignupController::class, 'index'])->name('signup.index');
Route::post('/signup', [SignupController::class, 'create'])->name('signup.create');

// Route::post('/signin', [SigninController::class, 'index'])->name('signin');


