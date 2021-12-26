<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order_Detail;
use App\Models\Product;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function getIndex(Request $request){
        $data['products'] = Product::paginate(10);
        return view('backend.warehouse',$data);
    }

    public function getWarehouse($value){
        if($value=='outofstock'){
            $data['products'] = Product::where('quantity','like',0)->paginate(10);
            $label = 'Sản phẩm hêt hàng';
        }elseif($value=='new'){
            $data['products'] = Product::orderBy('created_at','DESC')->paginate(10);
            $label = 'Sản phẩm mới nhất';
        }elseif($value=='selling'){
            $data['products'] = Product::where('qty_sell','>', 0)->paginate(10);
            $label = 'Sản phẩm bán chạy';
        }elseif($value=='notselling'){
            $data['products'] = Product::where('qty_sell','like', 0)->orWhereNull('qty_sell')->paginate(10);
            $label = 'Sản phẩm không bán được';
        }
        
        return view('backend.warehouse',$data)->with('thongbao',$label);
    }
}
