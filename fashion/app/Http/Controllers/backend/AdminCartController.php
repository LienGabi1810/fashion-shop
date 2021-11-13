<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
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

    public function getCartShip(){
        $data['order'] = Order::all()->where('ship','like',1);
        $data['ship'] = User::all()->where('role','like',3);
        return view('backend/cart/order-for-ship',$data);
    }
    
}
