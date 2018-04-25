<?php

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

Route::get('/', 'MasterpageController@index');

Route::get('/login', 'Auth\LoginController@showLoginForm');

//ROUTE PRODUK
//show data produk
Route::get('/produk', 'ProdukController@index');
//insert data produk
Route::get('/produk/create', 'ProdukController@create');
Route::post('/produk', 'ProdukController@store');
//edit data produk
Route::get('/produk/{id}/formedit', 'ProdukController@edit');
Route::put('/produk/{id}', 'ProdukController@update');
//delete data produk
Route::delete('/produk/{id}', 'ProdukController@destroy')->name('deleteproduk');

//ROUTE KARYAWAN
//show data karyawan
Route::get('/karyawan', 'KaryawanController@index');
//insert data karyawan
Route::get('/karyawan/create', 'KaryawanController@create');
Route::post('/karyawan', 'KaryawanController@store');
//edit data produk
Route::get('/karyawan/{id}/formedit', 'KaryawanController@edit');
Route::put('/karyawan/{id}', 'KaryawanController@update');
//delete data produk
Route::delete('/karyawan/{id}', 'KaryawanController@destroy')->name('deletekaryawan');

//ROUTE PELANGGAN
//show data pelanggan
Route::get('/pelanggan', 'PelangganController@index');
//insert data pelanggan
Route::get('/pelanggan/create', 'PelangganController@create');
Route::post('/pelanggan', 'PelangganController@store');
//edit data pelanggan
Route::get('/pelanggan/{id}/formedit', 'PelangganController@edit');
Route::put('/pelanggan/{id}', 'PelangganController@update');
//delete data pelanggan
Route::delete('/pelanggan/{id}', 'PelangganController@destroy')->name('deletepelanggan');

//ROUTE PENJUALAN
//show data penjualan
Route::get('/penjualan', 'PenjualanController@index');
//insert data penjualan
Route::get('/penjualan/create', 'PenjualanController@create');
Route::post('/penjualan', 'PenjualanController@store');
//edit data penjualan
Route::get('/penjualan/{id}/formedit', 'PenjualanController@edit');
Route::put('/penjualan/{id}', 'PenjualanController@update');
//delete data penjualan
Route::delete('/penjualan/{id}', 'PenjualanController@destroy')->name('deletepenjualan');

//ROUTE DETAIL PENJUALAN
//show data detail penjualan
Route::get('/detailpenjualan/{id}/showdetail', 'DetailPenjualanController@showdetail')->name('showdetail');
//insert data detail penjualan
Route::get('/detailpenjualan/{id}/create', 'DetailPenjualanController@create');
Route::post('/detailpenjualan', 'DetailPenjualanController@store');
//edit data detail penjualan
Route::get('/detailpenjualan/{id}/{iddetail}/formedit', 'DetailPenjualanController@edit');
Route::put('/detailpenjualan/{id}', 'DetailPenjualanController@update');
//delete data detail penjualan
Route::delete('/detailpenjualan/{id}/{idpenjualan}/{idproduk}/{jumlah}', 'DetailPenjualanController@destroy')->name('deletedetailpenjualan');

//ROUTE PEMBAYARAN
//show data pembayaran
Route::get('/pembayaran', 'PembayaranController@index');
//insert data pembayaran
Route::get('/pembayaran/create', 'PembayaranController@create');
Route::post('/pembayaran', 'PembayaranController@store');
//edit data pembayaran
Route::get('/pembayaran/{id}/formedit', 'PembayaranController@edit');
Route::put('/pembayaran/{id}', 'PembayaranController@update');
//delete data pembayaran
Route::delete('/pembayaran/{id}', 'PembayaranController@destroy')->name('deletepembayaran');

Route::get('logout', function (){
    Auth::logout();
});
