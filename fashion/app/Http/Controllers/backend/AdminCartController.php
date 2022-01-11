<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCartController extends Controller
{
    public function getCart(){
        $data['order'] = Order::paginate(10);
        return view('backend/cart/cart',$data);
    }


    public function getAddCart(){
        return view('backend/cart/add-cart');
    }

    public function getCartShip(){
        $data['order'] = Order::where('ship','like',1)->paginate(10);
        //dd($data['order']);
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
        if($value == '2'){
            $orderProduct = OrderProduct::where('order_id','like',$id)->get();
        }
        foreach($orderProduct as $value){
            $product = Product::find($value['product_id']);
            $product->qty_sell =  $product->qty_sell + $value['qty_prd'];
            $product->total_sell =  $product->price * ($product->qty_sell);
            $product->save();
        }
        // $updateProduct = Product::find($item->id);
            // $updateProduct->qty_sell =  $updateProduct->qty_sell + $item->qty;
            // $updateProduct->total_sell =  $item->price * ($updateProduct->qty_sell + $item->qty);
            // $updateProduct->save();
        return 'success';
    }

    public function orderDetail(Request $request){
        $dataRequest = $request->all();
        $id = $dataRequest['value'];
        //$id = 19;
        $order = Order::find($id);
        $infoArr = explode('|',rtrim($order->info,'||'));
        foreach($infoArr as $key => $value){
            $info = strstr($value, 'id');
            $idProduct = (int) filter_var($info, FILTER_SANITIZE_NUMBER_INT);
            
            $product = Product::find($idProduct);
            $code_product = $product->code;
            $name_product = $product->name;
            $price_product = $product->price;
            $totalPrd = $price_product * $value[0];
            $data[$key] = array(
                'quantity' => $value[0],
                'code' => $code_product,
                'name' => $name_product,
                'price' => $price_product,
                'totalPrd' => $totalPrd,
                'total' => $order->total,
            );
        }

        $html = '';
        foreach($data as $key => $value){
            $html .= '<tr>
                        <th scope="row">1</th>
                        <td>'.$value['code'].'</td>
                        <td>'.$value['name'].'</td>
                        <td>'.$value['quantity'].'</td>
                        <td>'.$value['price'].'</td>
                        <td>'.$value['totalPrd'].'</td>
                        </tr>
            ';
        }
        $result = array(
            'html' => $html,
            'total' => $order->total
        );

        echo json_encode($result);
    }
    
}
