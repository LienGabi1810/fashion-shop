<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Mail;

class CheckoutController extends Controller
{
    public function getCheckout(){
        return view('frontend.checkout');
    }

    public function getPost(Request $request){
        if(empty($request->is_login)){
            return redirect('/customerlogin')->with('thongbao','Bạn cần phải đăng nhập trước khi đặt hàng!');
        }
        $len = 30;
        $cod = substr(md5(rand()), 0, $len);
        // if(!empty($request->email_account)){
        //     foreach(Cart::content() as $row){
        //         $id = 0;
        //         $orderCustomer = new order_customer();
        //         $orderCustomer->id = $id++;
        //         $orderCustomer->name = $request->name;
        //         $orderCustomer->phone = $request->phone;
        //         $orderCustomer->email = $request->email;
        //         $orderCustomer->address = $request->address;
        //         $orderCustomer->status = 0;
        //         $orderCustomer->quantity =$row->qty;
        //         $orderCustomer->name_product = $row->name;
        //         $orderCustomer->COD = $cod;
        //         $account_id = Users::where('email',$request->email_account)->first()->id;
        //         $orderCustomer->account_id = $account_id;
        //         $orderCustomer->save();
        //    }
        // }

        $order = new Order();
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->total = Cart::total(0,'','');
        $order->COD = $cod;
        $order->ship_id = 0;
        $info = '';
        foreach(Cart::content() as $row){
            $info = $info.$row->qty.' '.$row->name.': '.($row->qty*$row->price) .'id='.$row->id.'|';
        }
        $order->info =  $info;
        $order->status_order = 0;
        $order->true_false = '0';
        $order->ship = '-1';
        $order->save();
        
        foreach(Cart::content() as $item){
            $orderDetail = new Order_Detail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->id;
            $orderDetail->qty = $item->qty;
            $orderDetail->product_name = $item->name;
            $orderDetail->price = $item->price;
            $orderDetail->customer_name = $request->name;
            $orderDetail->save();
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item->id;
            $orderProduct->qty_prd = $item->qty;
            $orderProduct->save();
        }

        $array = json_decode(json_encode(Cart::content()), True);
        foreach($array as $value){
            $product = Product::find($value['id']);
            $product->quantity = ($product->quantity) - ($value['qty']);
            $product->save();
        }

        //     foreach(Cart::content() as $row){
        //         $order = new order;
        //         $order->name = $row->name;
        //         $order->price = $row->price;
        //         $order->quantity = $row->qty;
        //         $order->image = $row->options->img;
        //         $order->product_id = $row->id;
        //         $order->customer_id = $customer->id;
        //         $order->month = now()->month;
        //         $order->year = now()->year;
        //         $order->save();
        //    }
           $info1 = '';
           foreach(cart::content() as $row)
           {
               $prdname = $row->name;
               $price = $row->price;
               $qty = $row->qty;
               $info1 = $info1.$row->qty.' '.$row->name.': '.($row->qty*$row->price).'||';
           }
           $data = array(
            'shop' => 'Liên Fashion kính chào quý khách.',
            //'id' =>$customer->id,
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'prdname' => $prdname,
            'info' => $info1,
            'tongtien' =>cart::total()
        );
        Mail::send('frontend.mail', $data, function ($message) use($request) {
                $message->from('nguyenthihonglien1098@gmail.com', 'admin');
                $message->to($request->email, $request->name);
                $message->subject('Xác nhận đơn hàng');
        });
        Cart::Destroy();
        return Redirect('/cart')->with('thongbao','Bạn đã đặt hàng thành công');
    }
    
}
