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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['prefix'=>'/'], function() {	
	Route::get('/', 'loginInfo@index');
	Route::get('login', 'loginInfo@login');
	Route::post('login', 'loginInfo@loging');
	Route::get('register', 'loginInfo@register');
	Route::post('register', 'loginInfo@registering');
	Route::get('visitor', 'loginInfo@visitor');
	Route::get('fb/{id}/{name}', 'loginInfo@fb');
	Route::get('google/{id?}/{name?}', 'loginInfo@google');
	//Route::get('change_mamber', 'loginInfo@register');
	Route::get('logout', 'loginInfo@logout');
	Route::get('firstads', 'showInfo@firstAds');
	Route::get('lastads', 'showInfo@lastAds');
	Route::post('saveads/{field}', 'showInfo@saveAds');
	Route::get('stuads', 'showInfo@stuAds');
	Route::post('stuads', 'showInfo@putStu');
	Route::get('check' , 'showInfo@check');
	Route::get('modify/{type}/{id}', 'showInfo@modify');
	Route::post('modify', 'showInfo@update');
	Route::get('delete/{type}/{id}', 'showInfo@delete');
	Route::get('plan_path', 'showInfo@planPath');
	//Route::get('full_path', 'showInfo@fullPath');
});
Route::group(['prefix'=>'admin/'], function() {
	Route::get('', 'adminInfo@login');
	Route::get('/logout', 'adminInfo@logout');
	Route::post('', 'adminInfo@loging');
	Route::post('writeLog', 'adminInfo@writeLog');
	Route::post('action', 'adminInfo@action');
});