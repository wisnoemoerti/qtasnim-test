<?php

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

Route::get('/', [App\Http\Controllers\BarangController::class, 'index']);

Route::get('/datatables',[App\Http\Controllers\BarangController::class, 'datatables'])->name('datatables');
Route::match(['post', 'put', 'delete'], '/crud', [App\Http\Controllers\BarangController::class, 'crud'])->name('barang_crud');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
