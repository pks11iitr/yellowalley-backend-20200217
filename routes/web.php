<?php



Auth::routes();

//Route::get('/', 'Website\HomeController@home')->name('website.home');
//Route::get('category','Website\HomeController@category')->name('website.category');
//Route::get('product/{id}', 'Website\ProductController@index')->name('website.product.details');
//Route::get('product-summary','Website\ProductController@productsummary')->name('website.product.summary');
//Route::get('specials-offer','Website\ProductController@specialsoffer')->name('website.specials.offer');
//Route::get('category/{id}', 'Website\CategoryController@products')->name('website.category.product');
//Route::post('add-cart', 'Website\CartController@addcart')->name('website.addcart');
//Route::get('cart-details', 'Website\CartController@cartDetails')->name('website.cartdetails');
//Route::get('contact','Website\ContactController@contact')->name('website.contact');
//Route::get('myorder','Website\MyorderController@index')->name('Website.myorder');
//
//Route::get('make-order', 'Website\MyorderController@make')->name('website.make.order');
//Route::get('confirm-n-pay/{id}', 'Website\MyorderController@setAddress')->name('website.confirmnpay');
//Route::post('verify-payment', 'Website\MyorderController@verifyPayment')->name('website.verifypayment');
//Route::get('order-history', 'Website\MyorderController@history')->name('website.order.history');


//this will be removed after setting proper redirection

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'admin', 'is'=>'admin'], function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::group(['prefix'=>'users'],function (){
        Route::get('/users','Admin\UsersController@index')->name('users.list');
        Route::get('create','Admin\UsersController@create')->name('users.create');
        Route::post('store','Admin\UsersController@store')->name('users.store');
        Route::get('edit/{id}','Admin\UsersController@edit')->name('users.edit');
        Route::post('update/{id}','Admin\UsersController@update')->name('users.update');
    });

    Route::group(['prefix'=>'chapter'], function(){
        Route::get('/','Admin\ChapterController@index')->name('chapter.list');
        Route::get('create','Admin\ChapterController@create')->name('chapter.create');
        Route::post('store','Admin\ChapterController@store')->name('chapter.store');
        Route::get('edit/{id}','Admin\ChapterController@edit')->name('chapter.edit');
        Route::post('update/{id}','Admin\ChapterController@update')->name('chapter.update');
    });

    Route::group(['prefix'=>'banners'], function(){
        Route::get('/','Admin\BannerController@index')->name('banners.list');
        Route::get('create','Admin\BannerController@create')->name('banners.create');
        Route::post('store','Admin\BannerController@store')->name('banners.store');
        Route::get('edit/{id}','Admin\BannerController@edit')->name('banners.edit');
        Route::post('update/{id}','Admin\BannerController@update')->name('banners.update');
    });

    Route::group(['prefix'=>'video'],function (){
        Route::get('/','Admin\VideoController@index')->name('video.list');
        Route::get('create','Admin\VideoController@create')->name('video.create');
        Route::post('store','Admin\VideoController@store')->name('video.store');
        Route::get('edit/{id}','Admin\VideoController@edit')->name('video.edit');
        Route::post('update/{id}','Admin\VideoController@update')->name('video.update');
    });

    Route::group(['prefix'=>'payment'],function (){
        Route::get('/','Admin\PaymentController@index')->name('payment.list');
    });

    Route::group(['prefix'=>'question'],function (){
        Route::get('/','Admin\QuestionController@index')->name('question.list');
        Route::get('create','Admin\QuestionController@create')->name('question.create');
        Route::post('store','Admin\QuestionController@store')->name('question.store');
        Route::get('edit/{id}','Admin\QuestionController@edit')->name('question.edit');
        Route::post('update/{id}','Admin\QuestionController@update')->name('question.update');
    });
    Route::group(['prefix'=>'userscore'],function (){
        Route::get('/','Admin\UserscoresController@index')->name('userscore.list');
    });

});

Route::get('privacy','Admin\TermController@privacy');
Route::get('term','Admin\TermController@term');
Route::get('abouts','Admin\TermController@abouts');
