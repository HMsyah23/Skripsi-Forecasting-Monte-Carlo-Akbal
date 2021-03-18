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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('home');
});

Route::get('admin/pengguna', function () {
    return view('pengguna');
})->name('pengguna');

Route::get('admin/barang', function () {
    return view('barang');
})->name('barang');

Route::get('admin/penjualan-barang', function () {
    return view('penjualan-barang');
})->name('penjualan-barang');

Route::get('admin/angka-random', function () {
    return view('angka-random');
})->name('angka-random');

Route::get('admin/prediksi-barang', function () {
    return view('prediksi-barang');
})->name('prediksi-barang');

Route::get('admin/monte-carlo', function () {
    return view('monte-carlo');
})->name('monte-carlo');

Route::get('admin/grafik', function () {
    return view('grafik');
})->name('grafik');

Route::get('admin/bantuan', function () {
    return view('bantuan');
})->name('bantuan');