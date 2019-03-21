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


route::any('/',"Index\IndexController@index");
route::any('/willshare',"Index\IndexController@willshare");
route::any('/allshops',"Index\AllshopsController@allshops");
route::any('/allshopsdo',"Index\AllshopsController@allshopsdo");
route::any('/userpage',"Index\UserpageController@userpage");
route::any('/shopcart',"Index\ShopcartController@shopcart");
route::any('/shopcontent/{id}',"Index\ShopcartController@shopcontent");
route::any('/mywallet',"Index\UserController@mywallet");
route::any('/set',"Index\UserController@set");
route::any('/edituser',"Index\UserController@edituser");
route::any('/address',"Index\UserController@address");
route::any('/invite',"Index\UserController@invite");
route::any('/safeset',"Index\UserController@safeset");
route::any('/login',"Index\LoginController@login");
route::any('/register',"Index\LoginController@register");
route::any('/findpwd',"Index\LoginController@findpwd");
route::get('/logindo',"Index\LoginController@logindo");
route::get('/outlogin',"Index\LoginController@outlogin");
route::get('/registerdo',"Index\LoginController@registerdo");
route::get('/regauth',"Index\LoginController@regauth");
route::get('/regauthdo',"Index\LoginController@regauthdo");
route::get('/regauthdoes',"Index\LoginController@regauthdoes");
route::get('/recorddetail',"Index\RecorddetailController@recorddetail");