<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function getIndex()
    {
        $emailCustomer = Auth::guard('customer')->user()->email;
        $data['order'] = Order::where('email','like',$emailCustomer)->paginate(10);
        return view('frontend.customer.customer',$data);
    }

    public function destroyCart(Request $r)
    {
        $data = $r->all();
        $id = $data['id'];
        $order = Order::find($id);
        $order->status_order = '-1';
        $order->save();
        $orderDetail = Order_Detail::where('order_id',$id)->get();
        foreach($orderDetail as $value){
            $product = Product::find($value['product_id']);
            $product->quantity = $product->quantity + $value['qty'];
            $product->save();
        }
        echo json_encode('success');
    }

    public function getInfo()
    {
        $id = Auth::guard('customer')->user()->id;
        $data['customer'] = Customer::find($id);
        return view('frontend.customer.info-customer',$data);
    }

    public function postInfo(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->name = $request->name;
        $customer->save();

        return redirect()->back()->with('thongbao','Chỉnh sửa thành công');
    }
}
