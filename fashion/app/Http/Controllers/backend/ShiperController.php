<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiperController extends Controller
{

    public  function getIndex()
    {
        $ship_id = Auth::user()->id;
        $data['order'] = Order::where('ship_id','like',$ship_id)->get();
        return view('/backend/shipper',$data);
    }

    public function changeStatus(Request $request){
        $data = $request;
        $id = $data['id'];
        $value = $data['value'];
        $order = Order::find($id);
        $order->status_order = $value;
        $order->save();
        echo json_encode('success');
    }
    
}
