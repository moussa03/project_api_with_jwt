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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['api',/*'checkpass'*/'ChangeLanguage'], 'namespace' => 'Api_Controller'], function () {

Route::post('get_api','test_api@get_info');
Route::get('get_user_id','test_api@category_by_id');
Route::post('change_status','test_api@changeStatus');
});


Route::group(['prefix'=>'admin','middleware'=>['api','check-admin-token'],'namespace'=>'Api_Controller'],function(){
    Route::post('get_list_users','test_api@get_users');
});


Route::group(['prefix'=>'admin','namespace'=>'Api_Controller\Admin'],function(){
    Route::post('login','AuthController@login');
    Route::post('logout','AuthController@logout')->middleware('auth-api:admin-api');
});

Route::group(['prefix'=>'profile','middleware'=>['api','auth-api:user-api'],'namespace'=>'Api_Controller\Profile'],function(){
    Route::post('login','AuthController@login');
    // Route::get('profile','AuthController@profile')->middleware('auth-api:user-api');
    Route::get('profile',function(){
      return \Auth::user();
    });

});
