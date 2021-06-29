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
Route::get('/', 'AuthController@showFormLogin')->name('login');

Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login')->name('auth.login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
 
    Route::get('pengguna', 'UserController@index')->name('pengguna');
    Route::post('pengguna', 'UserController@store')->name('user.store');
    Route::get('user/{id}', 'UserController@show')->name('user.show');
    Route::post('user/{id}', 'UserController@update')->name('user.update');
    Route::post('user/change/{id}', 'UserController@changePassword')->name('user.gantiPassword');
    Route::post('hapus/user/{id}', 'UserController@destroy')->name('user.destroy');


    Route::get('barang', 'BarangController@index')->name('barang');
    Route::post('barang', 'BarangController@store')->name('barang.store');
    Route::get('barang/buat', 'BarangController@buat')->name('barang.buat');
    Route::get('barang/{id}', 'BarangController@show')->name('barang.show');
    Route::post('barang/{id}', 'BarangController@update')->name('barang.update');
    Route::post('hapus/barang/{id}', 'BarangController@destroy')->name('barang.destroy');

    Route::get('penjualan-barang', 'PenjualanController@index')->name('penjualan-barang');
    Route::post('import-data-penjualan', 'PenjualanController@import')->name('import.data-penjualan');
    Route::get('penjualan-barang/analisa', 'PenjualanController@analisa')->name('analisa');

    Route::get('angka-random', function () {
        return view('angka-random');
    })->name('angka-random');

    Route::get('prediksi-barang', function () {
        return view('prediksi-barang');
    })->name('prediksi-barang');

    Route::get('monte-carlo', function () {
        return view('monte-carlo');
    })->name('monte-carlo');

    Route::get('grafik', function () {
        return view('grafik');
    })->name('grafik');

    Route::get('bantuan', function () {
        return view('bantuan');
    })->name('bantuan');

    Route::get('penjualan-barang/getDataBarang/{id}', 'PenjualanController@getBarang')->name('getBarang');
    Route::get('home', function () {
        return view('home');
    })->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');
    
});

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('barangs/export/', 'PenjualanController@export');

	// Laporan
	Route::get('/laporan/barang/{id}','LaporanController@laporanBarang')->name('laporan.Cbarang');
	Route::get('/laporan/barang','LaporanController@laporanSeluruhBarang')->name('laporan.barang');
	Route::get('/laporan/barangAja','LaporanController@laporanBarangAja')->name('laporan.barang.aja');