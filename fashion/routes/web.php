<?php

use App\Http\Controllers\backend\AdminCartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\AdminProductController;
use App\Http\Controllers\backend\AdminUserController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\ShiperController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\CustomerLoginController;

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

// ====== Frontend ===== 

//index
Route::get('/',[IndexController::class, 'getIndex']);

//login
Route::get('/customerlogin',[CustomerLoginController::class,'getLogin']);
Route::post('/customerlogin',[CustomerLoginController::class,'postLogin']);
Route::get('/customerlogout',[CustomerLoginController::class,'getCustomerLogout']);


//register
Route::get('/customerregister',[CustomerLoginController::class,'getRegister']);
Route::post('/customerregister',[CustomerLoginController::class,'postRegister']);

//contact
Route::get('/contact',[IndexController::class, 'getContact']);

//About
Route::get('/about',[IndexController::class, 'getAbout']);

//product
Route::group(['prefix' => 'product'], function () {
    Route::get('', [ProductController::class, 'getProduct']);
    Route::get('detail/{id}',[ProductController::class, 'getProductDetail']);
    Route::get('checkqty/{id}/{qty}',[ProductController::class, 'checkQty']);
});

//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('',  [CartController::class, 'getCart']);
    Route::get('add',  [CartController::class, 'getAddCart']);
    Route::get('remove/{id}',  [CartController::class, 'removeCart']);
    Route::get('update/{rowId}/{qty}/{id}',  [CartController::class, 'updateCart']);

});

//blog
Route::group(['prefix' => 'blog'], function () {
    Route::get('',  [BlogController::class, 'getBlog']); 
    Route::get('/detail',  [BlogController::class, 'getBlogDetail']); 

});

//checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('',[CheckoutController::class, 'getCheckout']); 
    Route::post('',[CheckoutController::class, 'getPost']);
});


//====BACKEND====

Route::get('/admin',[AdminController::class, 'getIndex'])->middleware('CheckLogin','CheckShipper');

Route::post('/admin/chart',[AdminController::class, 'getChart']);
Route::post('/admin/chart30day',[AdminController::class, 'getChart30day']);
Route::post('/admin/lastmonth',[AdminController::class, 'getLastMonth']);
Route::post('/admin/oneyear',[AdminController::class, 'getOneYear']);


//login

Route::get('/login',[LoginController::class, 'getLogin'])->middleware('CheckLogout');
Route::post('/login',[LoginController::class, 'postLogin']);
Route::get('/logout',[LoginController::class, 'getLogout']);

//category
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'category','middleware' => 'CheckManager','CheckLogin'], function () {
        Route::get('',  [CategoryController::class, 'getCategory']);
        Route::post('',  [CategoryController::class, 'postCategory']); 
        Route::get('category-edit/{id}',  [CategoryController::class, 'getEditCategory']); 
        Route::post('category-edit',  [CategoryController::class, 'postEditCategory']); 
        Route::get('category-delete/{id}',  [CategoryController::class, 'getDeleteCategory']);

    });

    //product
    Route::group(['prefix' => 'product','middleware' => 'CheckShipper'], function () {
        Route::get('',  [AdminProductController::class, 'getProduct']); 
        Route::get('add',  [AdminProductController::class, 'getAddProduct']); 
        Route::post('add',  [AdminProductController::class, 'postProduct']); 
        Route::get('edit/{id}',  [AdminProductController::class, 'getEditProduct']); 
        Route::post('edit/{id}',  [AdminProductController::class, 'postEditProduct']); 
        Route::get('delete/{id}',  [AdminProductController::class, 'deleteProduct']); 
    });

    //cart
    Route::group(['prefix' => 'cart','middleware' => 'CheckShipper'], function () {
        Route::get('',  [AdminCartController::class, 'getCart']); 
        Route::get('add',  [AdminCartController::class, 'getAddCart']);
        Route::get('ship',  [AdminCartController::class, 'getCartShip']); 
        Route::get('changetoship/{vlue}/{id}',  [AdminCartController::class, 'changeToShip']); 
        Route::get('changeship/{vlue}/{id}',  [AdminCartController::class, 'changeShip']); 
        Route::get('changestatus/{vlue}/{id}',  [AdminCartController::class, 'changeStatus']); 
    
    });

    //user
    Route::group(['prefix' => 'user','middleware' => 'CheckShipper','CheckManager'], function () {
        Route::get('',  [AdminUserController::class, 'getUser']); 
        Route::get('add',  [AdminUserController::class, 'getAddUser']);
        Route::post('add',  [AdminUserController::class, 'postAddUser']);
        Route::get('edit/{id}',  [AdminUserController::class, 'getEditUser']);
        Route::post('edit/{id}',  [AdminUserController::class, 'postEditUser']);
        Route::get('delete/{id}',  [AdminUserController::class, 'deleteUser']);
    
    });

    //ship
    Route::group(['prefix' => 'ship'], function () {
        Route::get('/',[ShiperController::class, 'getIndex']);
        Route::post('/changestatusship',[ShiperController::class, 'changeStatus']);
    
    });

});


