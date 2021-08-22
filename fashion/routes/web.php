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
    Route::get('detail',[ProductController::class, 'getProductDetail']);
});

//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('',  [CartController::class, 'getCart']);

});

//blog
Route::group(['prefix' => 'blog'], function () {
    Route::get('',  [BlogController::class, 'getBlog']); 
    Route::get('/detail',  [BlogController::class, 'getBlogDetail']); 

});

//checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('','frontend\CheckoutController@getCheckout');
    Route::get('complete','frontend\CheckoutController@getComplete');
    Route::post('','frontend\CheckoutController@postCheckout');
});


//====BACKEND====

Route::get('/admin',[AdminController::class, 'getIndex']);

//category
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('',  [CategoryController::class, 'getCategory']); 
    
    });


    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('',  [AdminProductController::class, 'getProduct']); 
        Route::get('add',  [AdminProductController::class, 'getAddProduct']); 
        Route::get('edit',  [AdminProductController::class, 'getEditProduct']); 
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
    
    });

});


