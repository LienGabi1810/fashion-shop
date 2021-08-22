<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function getProduct(){
        return view('/backend/product/product');
    }

    public function getAddProduct(){
        return view('/backend/product/add-product');
    }

    public function getEditProduct(){
        return view('/backend/product/edit-product');
    }
}
