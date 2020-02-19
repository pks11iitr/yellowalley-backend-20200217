<?php



Auth::routes();

Route::get('/', 'Website\HomeController@home')->name('website.home');
Route::get('category','Website\HomeController@category')->name('website.category');
Route::get('product/{id}', 'Website\ProductController@index')->name('website.product.details');
Route::get('product-summary','Website\ProductController@productsummary')->name('website.product.summary');
Route::get('specials-offer','Website\ProductController@specialsoffer')->name('website.specials.offer');
Route::get('category/{id}', 'Website\CategoryController@products')->name('website.category.product');
Route::post('add-cart', 'Website\CartController@addcart')->name('website.addcart');
Route::get('cart-details', 'Website\CartController@cartDetails')->name('website.cartdetails');
Route::get('contact','Website\ContactController@contact')->name('website.contact');
Route::get('myorder','Website\MyorderController@index')->name('Website.myorder');

Route::get('make-order', 'Website\MyorderController@make')->name('website.make.order');
Route::get('confirm-n-pay/{id}', 'Website\MyorderController@setAddress')->name('website.confirmnpay');
Route::post('verify-payment', 'Website\MyorderController@verifyPayment')->name('website.verifypayment');
Route::get('order-history', 'Website\MyorderController@history')->name('website.order.history');


//this will be removed after setting proper redirection

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'admin', 'is'=>'admin'], function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/users','Admin\UsersController@users')->name('users');
    Route::get('/usersdetail/{id}','Admin\UsersController@usersdetail')->name('usersdetail');
    Route::group(['prefix'=>'category'], function(){
        Route::get('/','Admin\CategoryController@index')->name('category.list');
        Route::get('create','Admin\CategoryController@create')->name('category.create');
        Route::post('store','Admin\CategoryController@store')->name('category.store');
        Route::get('edit/{id}','Admin\CategoryController@edit')->name('category.edit');
        Route::post('update/{id}','Admin\CategoryController@update')->name('category.update');
    });

    Route::group(['prefix'=>'banners'], function(){
        Route::get('/','Admin\BannerController@index')->name('banners.list');
        Route::get('create','Admin\BannerController@create')->name('banners.create');
        Route::post('store','Admin\BannerController@store')->name('banners.store');
        Route::get('edit/{id}','Admin\BannerController@edit')->name('banners.edit');
        Route::post('update/{id}','Admin\BannerController@update')->name('banners.update');

          });

    Route::group(['prefix'=>'products'],function (){
        Route::get('/','Admin\ProductsController@index')->name('products.list');
        Route::get('create','Admin\ProductsController@create')->name('products.create');
        Route::post('store','Admin\ProductsController@store')->name('products.store');
        Route::get('detail/{id}','Admin\ProductsController@detail')->name('products.detail');
        Route::get('edit/{id}','Admin\ProductsController@edit')->name('products.edit');
        Route::post('update/{id}','Admin\ProductsController@update')->name('products.update');
        Route::post('add-gallery/{id}','Admin\ProductsController@addgallery')->name('products.addgallery');
        Route::get('det-gallery/{id}','Admin\ProductsController@deletegallery')->name('products.detgallery');
    });
    Route::group(['prefix'=>'orders'],function (){
        Route::get('/','Admin\OrdersController@index')->name('orders.list');
        Route::get('detail/{id}','Admin\OrdersController@detail')->name('orders.detail');
        Route::get('change-status/{id}','Admin\OrdersController@changestatus')->name('order.status.change');
    });

});

Route::get('privacy','Admin\TermController@privacy');
Route::get('term','Admin\TermController@term');
Route::get('abouts','Admin\TermController@abouts');
