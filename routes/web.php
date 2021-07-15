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
    return view('x_login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallBack']);

Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallBack']);


Route::get('/kamar', [App\Http\Controllers\KamarController::class, 'index'])->name('kamar');
Route::post('/kamar/booking', [App\Http\Controllers\KamarController::class, 'booking'])->name('bookingkamar');
Route::get('/restaurant', [App\Http\Controllers\RestaurantController::class, 'index'])->name('restaurant');

Route::post('/restaurant/pesan', [App\Http\Controllers\RestaurantController::class, 'pesan'])->name('pesanmakan');
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index'])->name('akun');
Route::post('/akun/ubah-foto', [App\Http\Controllers\AkunController::class, 'editavatar'])->name('ubahfoto');
Route::post('/akun/update-data-diri', [App\Http\Controllers\AkunController::class, 'updatedatadiri'])->name('updatedatadiri');


