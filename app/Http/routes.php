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


/*-- ----------------------------
  ---- 前台页面
  -- ----------------------------*/

Route::get('/', 'HomeController@index');
Route::get('/article/{id}','HomeController@show');
Route::get('/category/{id}','HomeController@category');
Route::get('/tag/{id}','HomeController@tag');
Route::get('/about',function(){
    return '要不要增加个页面模型呢？';
});

/*-- ----------------------------
  ---- 登陆注册
  -- ----------------------------*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*-- ----------------------------
  ---- 后台管理
  -- ----------------------------*/
Route::get('/session',function(){
	$uid=session(['uid'=>10]);
  print_r($_SESSION);//问老弟
});
Route::get('/login',function(){
  
  echo "请登录";
});
Route::get('/setting',function(){
  
  echo "进入设置页面";
})->middleware('login');

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'auth'],function()
{
    //Markdown上传图片
    Route::post('/uploadImage','UploadController@uploadImage');

    Route::get('/','AdminController@index');

    Route::get('article/recycle', 'ArticleController@recycle');
    Route::get('article/destroy/{id}/','ArticleController@destroy');
    Route::get('article/restore/{id}', 'ArticleController@restore');
    Route::get('article/delete/{id}', 'ArticleController@delete');
    Route::resource('article','ArticleController');

    Route::get('category/destroy/{id}/','CategoryController@destroy');
    Route::resource('category','CategoryController');

    Route::get('tags/destroy/{id}/','TagController@destroy');
	Route::get('tags/ceshi','TagController@ceshi');
    Route::resource('tags','TagController');


});