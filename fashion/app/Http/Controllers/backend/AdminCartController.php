<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCartController extends Controller
{
    public function getCart(){
        return view('backend/cart/cart');
    }


    public function getAddCart(){
        return view('backend/cart/add-cart');
    }
}
