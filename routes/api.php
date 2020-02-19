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

    $api = app('Dingo\Api\Routing\Router');



    $api->post('login', ['as'=>'api.login', 'uses'=>'Auth\Api\LoginController@login']);
    $api->post('complete-profile', ['as'=>'api.login.complete', 'uses'=>'Auth\Api\LoginController@completeProfile']);
    $api->post('verify-otp', ['as'=>'api.otp.verify', 'uses'=>'Auth\Api\LoginController@verifyOTP']);


    $api->group(['middleware' => ['auth:api','acl'], 'is'=>'customer'], function ($api) {
        $api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
        $api->get('get-profile', ['as'=>'api.order.setprofile', 'uses'=>'Customer\Api\ProfileController@getProfile']);
        $api->post('update-profile', ['as'=>'api.order.setprofile', 'uses'=>'Customer\Api\ProfileController@updateProfile']);
        $api->get('subscribe', ['as'=>'api.order', 'uses'=>'Customer\Api\PaymentController@subscribe']);
        $api->post('verify-subscription', ['as'=>'api.order.verify', 'uses'=>'Customer\Api\PaymentController@verifyPayment']);
    });


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
