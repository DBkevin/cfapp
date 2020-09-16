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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/**
 * v1前缀命名组，api默认有，所以真实路径为localhost.com/api/v1
 */
Route::prefix('v1')->group(function () {
    Route::get('login', function () {
        return 'aaa';
    });
});
