<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register-admin', 'Admin\LoginController@register');


Route::post('register-sekolah', 'Api\SekolahController@register');
Route::post('delete-sekolah', 'Api\SekolahController@deleteSekolah');

Route::get('list-siswa','Api\UserController@index');
Route::post('register','Api\SekolahController@register');
Route::post('register-siswa','Api\USerController@register');
Route::post('login-siswa','Api\USerController@login');

Route::get('list-city','Api\SekolahController@getAllCity');
Route::get('list-province','Api\SekolahController@getAllProvince');

Route::get('province/{province_id}','Api\SekolahController@getCityFromProvince');
Route::get('detail-city/{id}','Api\SekolahController@getDetailCity');
Route::get('sekolah/{city_id}','Api\SekolahController@getSekolahFromCityProvince');
Route::get('list-sekolah','Api\SekolahController@getSekolah');