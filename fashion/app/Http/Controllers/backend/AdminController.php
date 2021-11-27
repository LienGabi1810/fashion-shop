<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Charts\UserChart;

class AdminController extends Controller
{
    public function getIndex(){
        $users = User::all();
        $countProduct = Product::all()->count();
        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('m');
        for($i=1;$i<=$month_n;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $numberjs[$i]=Order::where('status_order',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_n)->sum('total');

        }
        $data['monthjs'] = $monthjs;
        $data['numberjs'] = $numberjs;
        $data['order'] = Order::where('status_order',1)->count();
        $data['order_w'] = Order::where('status_order',0)->count();
        return view('/backend/index');
        //return view('/backend/index',$monthjs);
    }

    public function getChart(Request $request){
        $data = $request->all();
        $data['from_date'] = '2021-11-10';
        $data['to_date'] = '2021-11-12';
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Order::whereBetween('created_at',[$from_date,$to_date])->orderBy('created_at','ASC')->get();
            foreach($get as $key => $val){
                $chart_data[] = array(
                    'period' => $val->created_at,
                    'order' => 20,
                    'sales' => 1,
                    'quantity' => 40
                );
            }

        echo $data = json_encode($chart_data);
    }

    public function getChart30day(){
        $first_day = date('Y-m-01');
        $current_day = date('Y-m-d H:i:s');
        $current_month = date('m');
        $current_year = date('Y');

        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('m');
        for($i=1;$i<=$month_n;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $numberjs[$i]=Order::where('status_order',2)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_n)->sum('total');
            $get = Order::where('status_order',1)->whereMonth('updated_at', $current_month)->whereYear('updated_at',$current_year)->get();
        }
      
        foreach($numberjs as $key1 => $value1){
            $key = '2021-'.$key1;
            $chart_data[$key] = $value1;
        }
        foreach($chart_data as $key => $val){
            $data[] = array(
                'date' => $key,
                'total' => $val
            );
        }
        echo json_encode($data);
    }
}
