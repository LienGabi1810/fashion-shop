<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminCartController extends Controller
{
    public function getCart(){
        $data['order'] = Order::all();
        return view('backend/cart/cart',$data);
    }


    public function getAddCart(){
        return view('backend/cart/add-cart');
    }
}
