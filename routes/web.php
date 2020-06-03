<?php



//Auth::routes();

//admin login routes
Route::group( ['prefix'=>'admin'], function(){
    Route::group(['middleware'=>['guest']], function(){
        Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
        Route::get('password/reset', '\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::get('password/reset/otp', '\App\Http\Controllers\Auth\ForgotPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('admin.password.update');
        Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    });
    Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('admin.logout');
});


/*
 * *************************
 * Admin Panel Routes Starts
 * *************************
 */

Route::group(['middleware'=>['auth', 'acl'], 'prefix'=>'admin', 'is'=>'admin'], function(){
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::group(['prefix'=>'users'],function (){
        Route::get('/users','Admin\UsersController@index')->name('users.list');
        Route::get('create','Admin\UsersController@create')->name('users.create');
        Route::post('store','Admin\UsersController@store')->name('users.store');
        Route::get('edit/{id}','Admin\UsersController@edit')->name('users.edit');
        Route::post('update/{id}','Admin\UsersController@update')->name('users.update');
        Route::get('referral','Admin\UsersController@referral')->name('users.referral');
        Route::get('referral-details/{id}','Admin\UsersController@referralDetails')->name('users.referral.details');
        Route::get('delete/{id}','Admin\UsersController@delete')->name('users.delete');
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
        Route::get('delete/{id}','Admin\BannerController@delete')->name('banners.delete');
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
    Route::group(['prefix'=>'doubts'],function (){
        Route::get('/','Admin\DoubtController@index')->name('doubts.list');
    });
    Route::group(['prefix'=>'userscore'],function (){
        Route::get('/','Admin\UserscoresController@index')->name('userscore.list');
    });

});

/*
 * *************************
 * Admin Panel Routes Ends
 * *************************
 */

/*
 * *************************
 * Website Routes Starts
 * *************************
 */


Route::group(['middleware'=>['webguest']], function(){
    Route::get('login', 'Website\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Website\Auth\LoginController@login');
    Route::get('resend', 'Website\Auth\LoginController@resendOTP')->name('website.resend.otp');
    Route::get('complete-profile/{code}', 'Website\Auth\LoginController@profileform')->name('website.complete.profile');
    Route::post('complete-profile/{code}', 'Website\Auth\LoginController@completeProfile');
    Route::get('verify-otp', 'Website\Auth\LoginController@showOTPForm')->name('website.verify.otp');
    Route::post('verify-otp', 'Website\Auth\LoginController@verifyOTP');
    Route::get('password/reset', 'Website\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/otp', 'Website\Auth\ForgotPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Website\Auth\ResetPasswordController@reset')->name('password.update');
    Route::post('password/email', 'Website\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});
Route::post('logout', 'Website\Auth\LoginController@logout')->name('logout');


Route::get('/', 'Website\HomeController@home')->name('website.home');
Route::get('course-curriculum', 'Website\ChapterController@index')->name('website.chapters');

Route::group(['middleware'=>['webauth']], function(){
    Route::get('profile', 'Website\ProfileController@view')->name('website.profile');
    Route::post('profile', 'Website\ProfileController@update');
    Route::get('chapter-contents/{id}', 'Website\ChapterController@details')->name('website.chapter.details');
    Route::get('chapter-videos/{id}', 'Website\ChapterController@videos')->name('website.chapter.videos');
    Route::get('chapter-videos/{id}', 'Website\ChapterController@videos')->name('website.chapter.videos');
    Route::get('start-test/{id}', 'Website\TestController@start')->name('website.start.test');
    Route::get('attempt-question/{testid}/{questionid}', 'Website\QuestionController@view')->name('website.view.question');

    Route::post('attempt-question/{testid}/{questionid}', 'Website\QuestionController@putAnswer');
    Route::get('submit-test/{testid}', 'Website\TestController@viewSubmitTest')->name('website.test.submit');
    //Route::post('submit-test/{testid}', 'Website\TestController@submitTest');
    Route::get('show-score/{testid}', 'Website\TestController@submitTest')->name('website.show.score');
    Route::get('certificate', 'Website\TestController@getCertificateInfo')->name('website.certificate.info');

    Route::get('submit-doubt', 'Website\ChapterController@doubtForm')->name('website.submit.doubt');
    Route::post('submit-doubt', 'Website\ChapterController@submitDoubt');

    Route::get('subscribe', 'Website\PaymentController@view')->name('website.payment.info');
    Route::get('initiate-payment', 'Website\PaymentController@initiate')->name('website.pay');
    Route::post('verify-payment', 'Website\PaymentController@verify')->name('website.payment.verify');

});

Route::get('contact-us', 'Website\WebsiteController@contactForm')->name('website.contact.us');
Route::post('contact-us', 'Website\WebsiteController@submitQuery');
Route::get('privacy-policy','Website\WebsiteController@privacy')->name('website.privacy');
Route::get('term-and-conditions','Website\WebsiteController@tnc')->name('website.terms');
Route::get('about-yellowalley', 'Website\WebsiteController@about')->name('website.about.us');
Route::get('chat-with-us','Website\WebsiteController@chat')->name('website.chat');
Route::get('faqs','Website\WebsiteController@faqs')->name('website.faqs');



Route::get('download-certificate/{code}','Website\TestController@downloadCertificate')->name('website.certificate.download');

Route::get('privacy','Admin\TermController@privacy');
Route::get('term','Admin\TermController@term');
Route::get('about-us','Admin\TermController@abouts');
Route::get('chat','Admin\TermController@chat');
Route::get('faq','Admin\TermController@faq');
