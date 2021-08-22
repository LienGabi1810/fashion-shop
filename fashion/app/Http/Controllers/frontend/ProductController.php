<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * 
     */
    public function getProduct(){
        return view('/frontend/product/product');
    }

    /**
     * 
     */
    public function getProductDetail(){
        return view('/frontend/product/product-detail');
    }
}
