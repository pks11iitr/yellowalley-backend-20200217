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
        $api->get('home', ['as'=>'api.home', 'uses'=>'Auth\Api\LoginController@home']);
        $api->get('get-profile', ['as'=>'api.order.setprofile', 'uses'=>'Customer\Api\ProfileController@getProfile']);
        $api->post('update-profile', ['as'=>'api.order.setprofile', 'uses'=>'Customer\Api\ProfileController@updateProfile']);
        $api->post('add-cart', ['as'=>'api.cart', 'uses'=>'Customer\Api\CartController@store']);
        $api->get('cart-details', ['as'=>'api.cart.details', 'uses'=>'Customer\Api\CartController@getCartDetails']);
        $api->get('make-order', ['as'=>'api.order', 'uses'=>'Customer\Api\OrderController@make']);
        $api->get('order-details/{id}', ['as'=>'api.order.details', 'uses'=>'Customer\Api\OrderController@details']);
        $api->get('order-history', ['as'=>'api.order.history', 'uses'=>'Customer\Api\OrderController@history']);
        $api->get('cancel-order/{id}', ['as'=>'api.order.cancel', 'uses'=>'Customer\Api\OrderController@cancel']);
        $api->get('return/{id}', ['as'=>'api.order.return', 'uses'=>'Customer\Api\OrderController@returnOrder']);
        $api->get('get-address', ['as'=>'api.order.address', 'uses'=>'Customer\Api\OrderController@getAddress']);
        $api->post('set-address/{id}', ['as'=>'api.order.setaddress', 'uses'=>'Customer\Api\OrderController@setAddress']);
        $api->get('pay-now/{id}', ['as'=>'api.order.pay', 'uses'=>'Customer\Api\OrderController@paynow']);
        $api->post('verify-payment', ['as'=>'api.order.verify', 'uses'=>'Customer\Api\OrderController@verifyPayment']);
    });

    $api->get('category/{id}/subcategory', ['as'=>'api.category', 'uses'=>'Customer\Api\CategoryController@subcategory']);

    $api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
    $api->get('search', ['as'=>'api.search', 'uses'=>'Customer\Api\HomeController@search']);

    $api->get('category/{id}/product', ['as'=>'api.product', 'uses'=>'Customer\Api\CategoryController@cateproduct']);

    $api->get('product/{id}', ['as'=>'api.product', 'uses'=>'Customer\Api\ProductController@details']);




//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
