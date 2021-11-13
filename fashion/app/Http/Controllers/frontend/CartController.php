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
         // dd(cart::content());
         $data['cart'] = cart::content();
         $data['cartArray'] = $data['cart']->toArray();
         //dd($data['cartArray']);
         foreach($data['cartArray'] as $key => $value){
             $totalPrd = $value['price']*$value['qty'];
             $value['options']['totalPrd'] = $totalPrd;
         }
         //dd($data['cartArray']);
         $data['total'] = cart::total(0,'','');
        return view('/frontend/cart/shoping-cart',$data);
    }

    public function getAddCart(Request $r){
        // $prdId = $r->id_product;

        // $cart = Cart::content()->toArray();
        // foreach($cart as $key => $value){
        //     if($value['id'] == $prdId){
        //         Cart::update($value['rowId'], ())
        //     }
        // }
        //dd($cart);
    //     $cartt =  $cart->search(function ($cartItem ,$rowId ) {
    //         return $cartItem->id === $prdId ;
    //    });
        if(!empty($cartt)){
            $qty = Cart::get($cartt);
            dd($qty);
            //Cart::update($cartt,$r)
        }
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
            // $totalPrd = $prd['price']*$qty;
            // Cart::update($rowId,   ['options'  => ['totalPrd' => $totalPrd]]);
            Cart::update($rowId, $qty);
            return "success";
        }
    }
}
