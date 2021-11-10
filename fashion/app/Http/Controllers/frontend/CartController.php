<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCart(){
          //dd(cart::content());
         $data['cart'] = cart::content();
         $data['total'] = cart::total(0,'','');
        return view('/frontend/cart/shoping-cart',$data);
    }

    public function getAddCart(Request $r){
        $Product = Product::find($r->id_product);
        //$price =($Product->price)-(($Product->price/100)*($Product->sale));
        $price = $Product->price;
        if($r->has('quantity'))
        {
            Cart::add(['id' => $Product->id,
            'name' => $Product->name,
            'price' => $price,
            'qty' => $r->quantity,
            'weight' => 0,
            'options' => [
                'img' => $Product->image,
                'totalPrd' => $price*($r->quantity)
                ],
            ]);
        }
        // Cart::add(['id' => $Product->id,
        // 'name' => $Product->name,
        // 'price' => ($Product->price)-(($Product->price/100)*($Product->sale)),
        // 'qty' => 1,
        // 'weight' => 0,
        // 'totalPrd' => $price*$r->quantity,
        // 'options' => ['img' => $Product->image],
        // ]);
        //dd(cart::content());
        return redirect('/cart');
    }

    public function removeCart($id){
        Cart::remove($id);
        return redirect('/cart');

    }

    public function updateCart($rowId, $qty, $id){
        $prd =(array) DB::table('Product')->find($id);
        if(($prd['quantity']) < ($qty)){
            return "error";
        }else{
            $totalPrd = $prd['price']*$qty;
            Cart::update($rowId,   ['options'  => ['totalPrd' => $totalPrd]]);
            Cart::update($rowId,   ['qty'  => $qty]);
            return "success";
        }
    }
}
