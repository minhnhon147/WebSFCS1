<?php

use Illuminate\Support\Facades\Route;

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

Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaisp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);

Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getDatHang'
])->middleware('LoginMiddleware');

Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'

])->middleware('LoginMiddleware');

Route::get('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);

Route::get('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@getSignin'
]);

Route::get('admin',[
	'as'=>'admin',
	'uses'=>'AdminController@getLayout'
]);

Route::get('add',[
	'as'=>'add',
	'uses'=>'ProductController@getAddProduct'
]);

Route::group(['prefix'=>'admin'], function(){
	Route::group(['prefix'=>'products'], function(){

		Route::get('list','ProductController@getList');
		
		Route::get('add','ProductController@getAdd');
		Route::post('add','ProductController@postProduct');

		Route::post('edit/{id}','ProductController@postEdit');
		Route::get('edit/{id}','ProductController@getEdit');
		// Route::post('sua/{id}','XeController@postSua');

		 Route::get('delete/{id}','ProductController@getDelete');

	});
});

Route::group(['prefix'=>'admin'], function(){
	Route::group(['prefix'=>'bills'], function(){

		Route::get('list','BillController@getList');
		Route::get('detail/{id}','BillController@getDetail');
		Route::post('detail/{id}','BillController@postDetail');
		

	});
});

Route::group(['prefix'=>'admin'], function(){
	Route::group(['prefix'=>'users'], function(){

		Route::get('list','UserController@getList');

		Route::post('edit/{id}','UserController@postEdit');
		Route::get('edit/{id}','UserController@getEdit');
		

	});
});


Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);




Route::post('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@postLogin'	
]);



Route::post('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@postSignin'
]);

Route::get('dang-xuat',[
	'as'=>'logout',
	'uses'=>'PageController@getLogout'
]);


Route::get('login-google',[
	'as'=>'login-google'
	,'uses'=>'LoginController@login_google']);
Route::get('/google/callback','LoginController@callback_google');
