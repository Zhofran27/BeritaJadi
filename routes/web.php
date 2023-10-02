<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'revalidate'], function()
       {
    // Routes yang mau di revalidate masukan di sini

Auth::routes();
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/berita', [BeritaController::class,'index']);
Route::get('/kategori', [KategoriController::class,'index']);
Route::get('kategori/create', [KategoriController::class, 'create']);
Route::post('kategori/create', [KategoriController::class, 'store']);
Route::get('kategori/{id}',[KategoriController::class,'destroy']);
Route::get('kategori/edit/{id}',[KategoriController::class,'edit']);
Route::put('kategori/{id}',[KategoriController::class,'update']);
Route::get('/kategori', [KategoriController::class, 'search'])->name('search');
});

