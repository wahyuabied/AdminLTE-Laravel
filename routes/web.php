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
Route::group(['middleware' => ['auth']],function(){
	Route::get('/', 'Admin\DashboardController@index')->name('/');
	Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard');

	Route::get('logout','Admin\LoginController@logout')->name('logout');
	Route::get('sekolah', 'Admin\SekolahController@index')->name('sekolah');
	Route::get('siswa', 'Admin\SiswaController@index')->name('siswa');

});
Route::group(['middleware' => ['guest']],function(){
	Route::get('/login', 'Admin\LoginController@index')->name('login');
	Route::post('post-login', 'Admin\LoginController@postLogin')->name('post-login');
});





