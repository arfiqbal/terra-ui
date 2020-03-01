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

Route::get('create-vm', 'VmController@index');
Route::post('vm', 'VmController@store')->name('vm');;
Route::get('vm', 'VmController@show')->name('showVmLogs');
Route::post('vm/{id}', 'VmController@destroy')->name('deletevm');
Auth::routes();

Route::get('/', 'VmController@index')->name('home');

Route::get('/test', function(){
    return view('test');
});
