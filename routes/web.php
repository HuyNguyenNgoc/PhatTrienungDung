<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[
    'as'=>'index',
    'uses'=>'App\Http\Controllers\PageController@getIndex'
]);
Auth::routes();
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');
    Route::get('/chart', 'App\Http\Controllers\AdminController@chart')->name('chart');
    //tài khoản-------------
    route::get('/register','App\Http\Controllers\AdminController@getDangKy')->name('admin.register');
    route::post('/register','App\Http\Controllers\AdminController@postDangKy')->name('admin.register.submit');
   //Route::get('/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');

    //loại sản phẩm-------------
    Route::match(['get','post'],'/loaisp/themloaisp', 'App\Http\Controllers\AdminController@themLoaiSP')->name('admin.themloaisp');
    Route::get('/loaisp/xemloaisp', 'App\Http\Controllers\AdminController@xemLoaiSP')->name('admin.xemloaisp');
    Route::match(['get','post'],'/loaisp/sualoaisp/{id}', 'App\Http\Controllers\AdminController@suaLoaiSP')->name('admin.sualoaisp');
    Route::match(['get','post'],'/loaisp/xoaloaisp/{id}', 'App\Http\Controllers\AdminController@xoaLoaiSP')->name('admin.xoaloaisp');

    //sản phẩm-------------
    Route::match(['get','post'],'/sanpham/themsanpham', 'App\Http\Controllers\AdminController@themSanPham')->name('admin.themsanpham');
    Route::get('/sanpham/xemsanpham', 'App\Http\Controllers\AdminController@xemSanPham')->name('admin.xemsanpham');
    Route::match(['get','post'],'/sanpham/suasanpham/{id}', 'App\Http\Controllers\AdminController@suaSanPham')->name('admin.suasanpham');
    Route::match(['get','post'],'/sanpham/xoasanpham/{id}', 'App\Http\Controllers\AdminController@xoaSanPham')->name('admin.xoasanpham');
    Route::get('/xoa-img-sanpham/{id}', 'App\Http\Controllers\AdminController@xoaImgSanPham')->name('admin.xoaimgsanpham');

    //xử lý đơn hàng
    Route::get('/donhang/xulydonhang', 'App\Http\Controllers\AdminController@xuLyDonHang')->name('admin.xulidonhang');
    Route::get('/donhang/load-don-hang', 'App\Http\Controllers\AdminController@loadDonHang')->name('admin.loaddonhang');
    Route::match(['get','post'],'/donhang/xacnhandonhang/{id}', 'App\Http\Controllers\AdminController@xacNhanDonHang')->name('admin.xacnhandonhang');
    Route::match(['get','post'],'/xoadonhang/{id}', 'App\Http\Controllers\AdminController@xoaDonHang')->name('xoadonhang');
    Route::get('/donhang/xemdonhangdaduyet', 'App\Http\Controllers\AdminController@xemTinhTrangDonHangDaDuyet')->name('xemdonhangdaduyet');
    Route::match(['get','post'],'/donhang/xacnhandonhang2/{id}', 'App\Http\Controllers\AdminController@xacNhanDonhang2')->name('admin.xacnhandonhang2');
});

Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'App\Http\Controllers\PageController@getIndex'
]);

Route::get('dang-ky/',[
    'as'=>'signup-admin',
    'uses'=>'App\Http\Controllers\AdminController@getDangKy'
]);

Route::post('dang-ky/',[
    'as'=>'signup-admin',
    'uses'=>'App\Http\Controllers\AdminController@postDangKy'
]);

Route::get('loai-san-pham/{type}',[
    'as'=>'loai-san-pham',
    'uses'=>'App\Http\Controllers\PageController@getLoaiSanPham'
]);

// Route::get('san-pham-loai/{type}',[
//     'as'=>'san-pham-loai',
//     'uses'=>'App\Http\Controllers\PageController@getLoaiSanPham'
// ]);

// Route::group(['prefix' => 'loai-sanpham'], function () {        
    
//     Route::get('/banhkem', function () {   
//         return view('page/sanpham');
//     })->name('banhkem');
// });

Route::get('chitiet-sanpham/{id}',[
    'as'=>'chitiet-sanpham',
    'uses'=>'App\Http\Controllers\PageController@getChiTietSanPham'
]);

Route::get('add-cart/{MaSP}',[
    'as'=>'themgiohang',
    'uses'=>'App\Http\Controllers\PageController@getAddCart'
]);

Route::get('delete-cart/{id}',[
    'as'=>'xoagiohang',
    'uses'=>'App\Http\Controllers\PageController@getDeleteCart'
]);

Route::get('/giohang', 'App\Http\Controllers\PageController@gioHang')->name('giohang');
Route::post('/giohang/suasoluong/{id}', 'App\Http\Controllers\PageController@suaSoLuongGioHang')->name('suagiohang');

Route::match(['get','post'],'/register', 'App\Http\Controllers\PageController@register')->name('user.register');
Route::match(['get','post'],'/khach-hang-login', 'App\Http\Controllers\PageController@khachHangLogin')->name('user.KhachHangLogin');
Route::get('/khach-hang-logout', 'App\Http\Controllers\PageController@logout')->name('user.logout');

Route::group(['middleware' => 'userlogin'], function () {
    Route::match(['get','post'],'/mua-hang', 'App\Http\Controllers\PageController@getMuaHang')->name('muaHang');
    Route::match(['get','post'],'/order', 'App\Http\Controllers\PageController@Order')->name('order');
});

Route::get('lienhe',[
    'as'=>'contact',
    'uses'=>'App\Http\Controllers\PageController@getLienHe'
]);

Route::get('blog',[
    'as'=>'blog',
    'uses'=>'App\Http\Controllers\PageController@getBlog'
]);

Route::get('chef',[
    'as'=>'chef',
    'uses'=>'App\Http\Controllers\PageController@getChef'
]);

Route::get('about',[
    'as'=>'about',
    'uses'=>'App\Http\Controllers\PageController@getAbout'
]);

Route::get('/timkiem', 'App\Http\Controllers\PageController@search')->name('search');

