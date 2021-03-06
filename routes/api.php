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
    //书信token
    Route::put('authorizations/current', 'AuthorizationsController@update')
        ->name('authorizations.update');
    // 某个用户的详情
    Route::get('users/{user}', 'UsersController@show')
        ->name('users.show');
    //公司列表
    Route::get('company', 'CompanyController@index')
        ->name('companyList');
    Route::get("company/{company}", 'CompanyController@show')->name('company.show');
    //咖啡
    Route::get('cafes', 'CafeController@index')->name('cafes.list');
    Route::get('cafes/{cafe}', 'CafeController@show')->name('cafes.show');
    //tag
    Route::get('tags', 'TagsController@index')->name('tags.index');
    /**
     *需要登陆的
     */
    Route::middleware('auth:api')->group(function () {
        // 删除token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('authorizations.destroy');
        // 当前登录用户信息
        Route::get('user', 'UsersController@me')
            ->name('user.show');
        // 上传图片
        Route::post('images', 'ImagesController@store')
            ->name('images.store');
        //编辑登陆用户信息  //patch 部分修改资源，提供部分资源信息。
        Route::patch('user', 'UsersController@update')
            ->name('user.update');
        //新建公司
        Route::post('company', 'CompanyController@store')
            ->name('company.create');
        //新建店铺
        Route::post('cafes', 'CafeController@store')->name('cafes.store');
        Route::patch('cafes/{cafe}', 'CafeController@update')->name("cafes.update");
        //新建冲泡方法
        Route::post('methods', 'BrewMethodController@store')->name('methods.store');
        //更新冲泡方法
        Route::patch('methods/{method}', 'BrewMethodController@update')->name('methods.store');
        //新增Tag
        Route::post('tags', 'TagsController@store')->name('tags.store');
        //删除tag
        Route::delete('tags/{tag}', 'TagsController@destroy')->name('tags.destroy');
    });
});
