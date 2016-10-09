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
Route::any('admin/login','Admin\LoginController@login');//any表示任何http请求;

//登不登入都可以访问的方法;
Route::group(['middleware'=>['web']],function(){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('admin/code','Admin\LoginController@code');//验证码图片;
    Route::get('admin/getCode','Admin\LoginController@getCode');//验证码字符串;
    Route::get('admin/getEncrypt','Admin\LoginController@getEncrypt');//获取crypt加密字符串;
});

//登入后才能访问的方法(后台);
Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('info','IndexController@info');//后台信息页;
    Route::get('index','IndexController@index');//后台欢迎页;
    Route::get('quit','LoginController@quit');//退出登入;
    Route::get('category/changeOrder','CategoryController@changeOrder');//ajax修改分类排序;
    Route::get('links/changeOrder','LinksController@changeOrder');//ajax修改友链排序;
    Route::get('navs/changeOrder','NavsController@changeOrder');//ajax修改友链排序;
    Route::get('config/changeOrder','ConfigController@changeOrder');//ajax修改网站配置排序;
    Route::get('config/changeContent','ConfigController@changeContent');//ajax修改网站配置内容;
    Route::get('config/putFile','ConfigController@putFile');//将配置项写入配置文件;

    Route::resource('category','CategoryController');//文章分类;
    Route::resource('article','ArticleController');//文章;
    Route::resource('links','LinksController');//友情链接;
    Route::resource('navs','NavsController');//导航;
    Route::resource('config','ConfigController');//网站配置;


    Route::resource('upload','CommonController@upload');//图片上传处理;
});
Route::any('admin/pass','Admin\IndexController@pass');//修改密码;



//后台默认路由;
//Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['web']],function(){
//    Route::get('login','LoginController@login');
//});

/**
 * 前台路由
 */
Route::group(['namespace'=>'Home'],function(){
   Route::get('/','IndexController@index');//前台首页
   Route::get('/list/{cate_id}','IndexController@artList');//前台列表页
   Route::get('/art/{art_id}','IndexController@art');//前台文章详情页
   Route::get('/me','IndexController@me');//前台文章详情页
   Route::get('/gbook','IndexController@gbook');//前台文章详情页
   Route::get('/talk','IndexController@talk');//前台文章详情页
});
























/*Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
});


Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');

    Route::resource('category', 'CategoryController');
});*/
