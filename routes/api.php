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
    $api->get('payment-info', ['as'=>'api.order', 'uses'=>'Customer\Api\PaymentController@paymentInfo']);

    $api->group(['middleware' => ['auth:api','acl'], 'is'=>'student'], function ($api) {
        $api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
        $api->get('chapters', ['as'=>'api.chapters', 'uses'=>'Customer\Api\ChapterController@index']);
        $api->get('chapter-questions/{id}', ['as'=>'api.chapter.videos', 'uses'=>'Customer\Api\ChapterController@questions']);
        $api->get('get-profile', ['as'=>'api.order.setprofile', 'uses'=>'Customer\Api\ProfileController@getProfile']);
        $api->post('update-profile', ['as'=>'api.order.setprofile', 'uses'=>'Customer\Api\ProfileController@updateProfile']);

        //Payments APIs
        $api->get('subscribe', ['as'=>'api.order', 'uses'=>'Customer\Api\PaymentController@subscribe']);
        $api->post('verify-subscription', ['as'=>'api.order.verify', 'uses'=>'Customer\Api\PaymentController@verifyPayment']);

        //update last played video
        $api->post('update-video', ['as'=>'api.video.update', 'uses'=>'Customer\Api\ProfileController@updateLastPlayed']);

        //test apis
        $api->get('start-test/{id}', ['as'=>'api.start.test', 'uses'=>'Customer\Api\TestController@start']);
        $api->post('get-question', ['as'=>'api.question.get', 'uses'=>'Customer\Api\TestController@getQuestion']);
        $api->post('give-answer', ['as'=>'api.question.answer', 'uses'=>'Customer\Api\TestController@answer']);
        $api->post('submit-test', ['as'=>'api.test.finalsubmit', 'uses'=>'Customer\Api\TestController@submitTest']);


    });


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
