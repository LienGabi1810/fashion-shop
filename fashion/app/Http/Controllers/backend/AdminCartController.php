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

    public function changeToShip($value, $id){
        $order = Order::find($id);
        $order->ship = $value;
        if($value == 0){
            $order->status_order = 1;
        }
        $order->save();
        return 'success';
    }

    public function changeShip($value, $id){
        $order = Order::find($id);
       
        $order->ship_id = $value;
        if($value){
            $order->status_order = 1;
        }
        $order->save();
        return 'success';
    }

    public function changeStatus($value, $id){
        $order = Order::find($id);
        $order->status_order = $value;
        $order->save();
        return 'success';
    }
    
}
