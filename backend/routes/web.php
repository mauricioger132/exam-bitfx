<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Routes vendors*/

Route::match(['GET','POST'],'/import-vendors', [App\Http\Controllers\VendorController::class, 'importVendors'])->name('import.vendors');
Route::get('/cancel', function () {
    session()->flash('danger', 'Operacion cancelada');
    return redirect()->route('home');
})->name('cancel');
Route::post('/add-pwd',[App\Http\Controllers\VendorController::class, 'addPassword'])->name('add.password');