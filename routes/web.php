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
    return view('welcome');
});

Auth::routes();
Route::get('geocode', function () {
    return \App\Handlers\GaodeMapsHandler::geocodeAddress('天城路1号', '杭州', '浙江');
});

Route::get('/home', 'HomeController@index')->name('home');
