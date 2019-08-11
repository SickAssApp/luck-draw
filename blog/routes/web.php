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
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/main', 'MainController@index')->name('home');
Route::post('/main/checkLogin', 'MainController@checkLogin');
Route::get('/main/successLogin', 'MainController@successLogin')->middleware('chkLogin');
Route::get('/main/logout', 'MainController@logout');

Route::group(['prefix'=>'luckydraw','as'=>'luckydraw.', 'middleware' => 'chkLogin'], function(){
    Route::get('/', 'LuckydrawController@index');
    Route::post('/getdraw', 'LuckydrawController@genLuckyDrawResult');
});

Route::group(['prefix'=>'member','as'=>'member.', 'middleware' => 'chkLogin'], function(){
    Route::get('/', 'MemberController@index');
    Route::post('/newWinNumber', 'MemberController@newWinNumber');
});

Route::group(['prefix'=>'showdraw','as'=>'showdraw.'], function(){
    Route::get('/', 'ShowDrawController@index');
    Route::get('/getdrawresult', 'ShowDrawController@getDrawResult');
});