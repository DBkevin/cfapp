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
Route::prefix('v1')->namespace('Api')->name('api.v1')->group(function () {
    // 用户注册
    Route::post('users', 'UsersController@store')->name('users.store');
    //第三方登陆
    Route::post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
        ->where('social_type', 'wechat')
        ->name('socials.authorizations.store');
    //使用where显示scial_type只能为微信
    // 登录
    Route::post('authorizations', 'AuthorizationsController@store')
        ->name('api.authorizations.store');
    Route::put('authorizations/current', 'AuthorizationsController@update')
        ->name('authorizations.update');
    //其他登陆用户
    // 某个用户的详情
    Route::get('users/{user}', 'UsersController@show')
        ->name('users.show');
    // 刷新token
    Route::middleware('auth:api')->group(function () {
        // 删除token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('authorizations.destroy');
        // 当前登录用户信息
        Route::get('user', 'UsersController@me')
            ->name('user.show');
    });
});
