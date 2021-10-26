<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'AuthController@login');
Route::post('/user/tambah', 'UserController@store');

//USER
Route::get("/get_user", "UserController@index");
Route::get("/get_detail_user/{id_user}", "UserController@detail_user");
Route::post('/user', 'UserController@insert_user');
Route::put("/update_user/{id_user}", "UserController@update_user");
Route::delete("/delete_userk/{id_user}", "UserController@delete_user");

//TRANSAKSI
Route::get("/get_transaksi", "TransaksiController@index");
Route::get("/get_detail_transaksi/{id_transaksi}", "TransaksiController@detail_transaksi");
Route::post('/transaksi', 'TransaksiController@insert_transaksi');
Route::put("/update_transaksi/{id_transaksi}", "TransaksiController@update_transaksi");
Route::delete("/delete_transaksi/{id_transaksi}", "TransaksiController@delete_transaksi");

//PAKET
Route::get("/get_paket", "PaketController@index");
Route::get("/get_detail_paket/{id_paket}", "PaketController@detail_paket");
Route::post('/paket', 'PaketController@insert_paket');
Route::put("/update_paket/{id_paket}", "PaketController@update_paket");
Route::delete("/delete_paket/{id_paket}", "PaketController@delete_paket");

//MEMBER
Route::get("/get_member", "MemberController@index");
Route::get("/get_detail_member/{id_member}", "MemberController@detail_member");
Route::post('/member', 'MemberController@insert_member');
Route::put("/update_member/{id_member}", "MemberController@update_member");
Route::delete("/delete_member/{id_member}", "MemberController@delete_member");

//DETAIL TRANSAKSI
Route::get("/get_detail_transaksi", "DetailTransaksiController@index");
Route::get("/detail_transaksi/{id_detail_transaksi}", "DetailTransaksiController@detail_detail_transaksi");
Route::post('/detail_transaksi', 'DetailTransaksiController@insert_detail_transaksi');
Route::put("/update_detail_transaksi/{id_detail_transaksi}", "DetailTransaksiController@update_detail_transaksi");
Route::delete("/delete_detail_transaksi/{id_detail_transaksi}", "DetailTransaksiController@delete_detail_transaksi");
