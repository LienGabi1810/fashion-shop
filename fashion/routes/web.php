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
use App\Http\Controllers\frontend\CheckoutController;

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

Route::get('/admin',[AdminController::class, 'getIndex'])->middleware('CheckLogin');

//login

Route::get('/login',[LoginController::class, 'getLogin'])->middleware('CheckLogout');
Route::post('/login',[LoginController::class, 'postLogin']);
Route::get('/logout',[LoginController::class, 'getLogout']);

//category
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('',  [CategoryController::class, 'getCategory'])->middleware('auth');
        Route::post('',  [CategoryController::class, 'postCategory'])->middleware('CheckLogin'); 
        
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('',  [AdminProductController::class, 'getProduct'])->middleware('CheckLogout'); 
        Route::get('add',  [AdminProductController::class, 'getAddProduct']); 
        Route::post('add',  [AdminProductController::class, 'postProduct']); 
        Route::get('edit/{id}',  [AdminProductController::class, 'getEditProduct']); 
        Route::post('edit/{id}',  [AdminProductController::class, 'postEditProduct']); 
        Route::get('delete/{id}',  [AdminProductController::class, 'deleteProduct']); 
    });

    //cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('',  [AdminCartController::class, 'getCart']); 
        Route::get('add',  [AdminCartController::class, 'getAddCart']);
    
    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('',  [AdminUserController::class, 'getUser']); 
        Route::get('add',  [AdminUserController::class, 'getAddUser']);
        Route::post('add',  [AdminUserController::class, 'postAddUser']);
        Route::get('edit/{id}',  [AdminUserController::class, 'getEditUser']);
        Route::post('edit/{id}',  [AdminUserController::class, 'postEditUser']);
        Route::get('delete/{id}',  [AdminUserController::class, 'deleteUser']);
    
    });

});


