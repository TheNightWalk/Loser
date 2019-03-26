<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::match(['post','get'],'index/hello', function () {
    echo 'hello world';
});

route::match(['post','get'],'index/{id}/{username}', function ($id,$username) {
    echo $id;
})->where(['id'=>"[0-9]{3,}"]);

route::get('index/index','Admin\AdminController@index');
route::post('index/indexdo','Admin\AdminController@indexdo');
route::get('index/indexdoes','Admin\AdminController@indexdoes');
route::get('user/user','Admin\UserController@index');
route::post('user/userdo','Admin\UserController@indexdo');
route::get('/user/login','Admin\UserController@login');
route::post('/user/logindo','Admin\UserController@logindo');
route::get('user/pwdedit/{id}','Admin\UserController@pwdedit');
route::post('user/pwdeditdo','Admin\UserController@pwdeditdo');
route::get('index/salute','Admin\AdminController@salute');
route::get('index/unsalute','Admin\AdminController@unsalute');
route::get('index/lists/{id}','Admin\AdminController@lists');
route::get('index/listsdo','Admin\AdminController@listsdo');
route::get('test/test','Test\TestController@test');
route::post('test/testdo','Test\TestController@testdo');
route::get('test/list','Test\TestController@lists');
route::get('test/del','Test\TestController@del');
route::get('test/search','Test\TestController@search');
route::get('index/audit','Admin\AdminController@audit');
route::get('index/auditdo','Admin\AdminController@auditdo');