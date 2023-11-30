<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});


// Category Controller
Route::get('/all/category',[CategoryController::class,'index'])->name('AllCat');
// Add Category Controller
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('add.category');
// Edit Category Controller
Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
// Update Category Controller
Route::post('/category/update/{id}', [CategoryController::class, 'Update'])->name('update.category');

Route::get('/category/remove/{id}', [CategoryController::class, 'RemoveCat']);
Route::get('/category/restore/{id}', [CategoryController::class, 'RestoreCat']);
Route::get('/category/delete/{id}', [CategoryController::class, 'DeleteCat']);

// Brand Controller
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('brand');
Route::post('/brand/add',[BrandController::class,'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class,'Update'])->name('update.brand');
Route::get('/brand/remove/{id}',[BrandController::class,'RemoveBrand']);
