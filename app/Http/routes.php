<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//获取验证码
Route::get('/login/code','LoginController@code');

//搜索功能
Route::any('/seachs/','CommonController@seachs')->name('common.seachs');

//前端页面
Route::group(['namespace'=>'Home'], function () {
    Route::get('/', 'IndexController@index')->name('index.index');
    Route::get('/showlist/{id}', 'IndexController@showlist')->name('index.list');
    Route::get('/show/{id}/', 'IndexController@show')->name('index.show');

    //原创视频
    Route::get('/originalvideo/index', 'OriginalVideoController@index')->name('originalvideo.index');
    Route::get('/originalvideo/show/{id}/{issue?}', 'OriginalVideoController@showvideo')->name('video.show');
    Route::get('/originalvideo/showlist/{title}', 'OriginalVideoController@showlist')->name('originalvideo.lists');

    //活力四川
    Route::get('/vitality/index', 'VitalityController@index')->name('vitality.index');
    Route::get('/vitality/{id}','VitalityController@lists')->name('vitality.lists');
    Route::get('/vitality/{id}/show','VitalityController@show')->name('vitality.show');

    //大医精诚
    Route::get('/doctor/index', 'DoctorController@index')->name('doctor.index');
    Route::get('/doctor/{id}','DoctorController@lists')->name('doctor.lists');
    Route::get('/doctor/{id}/show','DoctorController@show')->name('doctor.show');
    Route::get('/doctor/{id}/videoshow','DoctorController@videoshow')->name('doctor.videoshow');

    //健康教育
    Route::get('/healthy/index','HealthyController@index')->name('healthy.index');

    //健康公益
    Route::get('/welfare/index','WelfareController@index')->name('welfare.index');
    Route::get('/welfare/{id}','WelfareController@lists')->name('welfare.lists');
    Route::get('/welfare/{id}/show','WelfareController@show')->name('welfare.show');

    //权威发布
    Route::get('/authority/index','AuthorityController@index')->name('authority.index');
    //关于我们
    Route::get('/about/index','AboutController@index')->name('about.index');

});


//管理者登录地址
Route::group(['middleware' => ['web']], function () {
    Route::any('/login','LoginController@index');
    Route::get('/login/quit','LoginController@quit');
    Route::post('admin/uplode','CommonController@uplode');
    //后台新闻推荐处理
    Route::post('news','CommonController@news')->name('news.index');
});
//Route::get('admin/index','Admin\IndexController@index');//后台首页

//后台操作中心
Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('/index','IndexController@index');//后台首页

    //后台用户管理
    Route::resource('userslist','UsersController');
    //后台分类管理
    Route::resource('category','CategoryController');

    //后台广告管理
    Route::any('advert/audit','AdvertController@audit');//待审核
    Route::any('advert/publish','AdvertController@publish');//待发布
    Route::any('advert/published','AdvertController@published');//已发布
    Route::resource('advert','AdvertController');

    //后台广告位管理
    Route::resource('adposition','AdpositionController');


    //后台幻灯片管理
    Route::any('slide/pendingaudit','SlideController@audit');//待审核
    Route::any('slide/pendingrelease','SlideController@pendingrelease');//待发布
    Route::any('slide/released','SlideController@released');//已发布
    Route::resource('slide','SlideController');

    //友情链接
    Route::any('links/seach','LinksController@seach');
    Route::any('links/pendingaudit','LinksController@audit');//发布管理
    Route::resource('links','LinksController');

    //合作机构
    Route::any('agency/seach','AgencyController@seach');
    Route::any('agency/pendingaudit','AgencyController@audit');//发布管理
    Route::resource('agency','AgencyController');

    //后台文章管理
    Route::any('article/seach','ArticleController@seach');

    Route::get('article/statusList/{status}','ArticleController@statusList');
    Route::post('article/editState','ArticleController@editState');
    Route::resource('article','ArticleController');

    //后台系统设置
    Route::any('system','SystemController@index');


    //后台视频管理
    Route::any('video/seach','VideoController@seach');
    Route::get('video/statusList/{status}','VideoController@statusList');//获取不同状态的视频
    Route::post('video/editState','VideoController@editState');
    Route::any('video/recommendList','VideoController@recommendList');
    Route::get('video/issues/{id}','VideoController@issues');
    Route::get('video/editIssue/{id}','VideoController@editIssue');
    Route::any('video/delIssue/{id}','VideoController@delIssue');
    Route::get('video/addIssue/{id}','VideoController@addIssue');
    Route::post('video/storeIssue/{id?}','VideoController@storeIssue');
    Route::post('video/editIssueStatus','VideoController@editIssueStatus');
    Route::resource('video','VideoController');
});



