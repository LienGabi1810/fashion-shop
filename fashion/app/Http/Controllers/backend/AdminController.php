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
        $day_n = Carbon::now()->format('d');
        for($i=1;$i<=$day_n;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $numberjs[$i]=Order::where('status_order',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_n)->sum('total');
            $dayjs[$i] = $i;
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
        $current_month = $data['month'];
        $current_year =  $data['year'];

        $year_n = Carbon::now()->format('Y');
        $day_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
        for($i=1;$i<=$day_in_month;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $dayjs[$i] = $i;
            $numberjs[$i]=Order::where('status_order',2)->whereDay('updated_at',$i)->whereMonth('updated_at', $current_month)->whereYear('updated_at',$year_n)->sum('total');
            $get = Order::where('status_order',2)->whereDay('updated_at', $i)->whereMonth('updated_at', $current_month)->whereYear('updated_at',$current_year)->get();
            $count[$i] = count($get);
        }
        foreach($numberjs as $key1 => $value1){
            $date = $key1;
            if(strlen($date)<2){
                $date = '0'.$date;
            }
            $key = '2021-'.$current_month.'-'.$date;
            $chart_data[$key]['sales'] = $value1;
        }
        
        foreach($count as $key2 => $value2){
            $date2 = $key2;
            if(strlen($date2)<2){
                $date2 = '0'.$date2;
            }
            $key = '2021-'.$current_month.'-'.$date2;
            $chart_data[$key]['total'] = $value2;
        }
        foreach($chart_data as $key => $val){
            $return[] = array(
                'date' => $key,
                'sales' => $val['sales'],
                'total' => $val['total'],
            );
        }
        echo json_encode($return);
    }

    public function getChart30day(Request $request){
        $data = $request->all();
        $current_month = Carbon::now()->format('m');

        $year_n = Carbon::now()->format('Y');
        $day_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $year_n);
        for($i=1;$i<=$day_in_month;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $dayjs[$i] = $i;
            $numberjs[$i]=Order::where('status_order',2)->whereDay('updated_at',$i)->whereMonth('updated_at', $current_month)->whereYear('updated_at',$year_n)->sum('total');
            $get = Order::where('status_order',2)->whereDay('updated_at', $i)->whereMonth('updated_at', $current_month)->whereYear('updated_at',$year_n)->get();
            $count[$i] = count($get);
        }
        foreach($numberjs as $key1 => $value1){
            $date = $key1;
            if(strlen($date)<2){
                $date = '0'.$date;
            }
            $key = '2021-'.$current_month.'-'.$date;
            $chart_data[$key]['sales'] = $value1;
        }
        
        foreach($count as $key2 => $value2){
            $date2 = $key2;
            if(strlen($date2)<2){
                $date2 = '0'.$date2;
            }
            $key = '2021-'.$current_month.'-'.$date2;
            $chart_data[$key]['total'] = $value2;
        }
        foreach($chart_data as $key => $val){
            $return[] = array(
                'date' => $key,
                'sales' => $val['sales'],
                'total' => $val['total'],
            );
        }
        echo json_encode($return);
    }

    public function getLastMonth(){
        $first_day = date('Y-m-01');
        $current_day = date('Y-m-d H:i:s');
        $current_month = date('m');
        $current_year = date('Y');
        $last_month = $current_month-1;
       
        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('m');
        $day_n = Carbon::now()->format('d');
        $day_in_month = cal_days_in_month(CAL_GREGORIAN, $last_month, $current_year);
        for($i=1;$i<=$day_in_month;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $dayjs[$i] = $i;
            $numberjs[$i]=Order::where('status_order',2)->whereDay('updated_at',$i)->whereMonth('updated_at',$last_month)->whereYear('updated_at',$year_n)->sum('total');
            $get = Order::where('status_order',2)->whereDay('updated_at', $i)->whereMonth('updated_at',$last_month)->whereYear('updated_at',$current_year)->get();
            $count[$i] = count($get);
        }
        foreach($numberjs as $key1 => $value1){
            $key = '2021-'.$last_month.'-'.'0'.$key1;
            $chart_data[$key]['sales'] = $value1;
        }
        
        foreach($count as $key2 => $value2){
            $key = '2021-'.$last_month.'-'.'0'.$key2;
            $chart_data[$key]['total'] = $value2;
        }
        
        foreach($chart_data as $key => $val){
            $data[] = array(
                'date' => $key,
                'sales' => $val['sales'],
                'total' => $val['total'],
            );
        }
        echo json_encode($data);
    }

    public function getOneYear(){
       
        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('m');
        for($i=1;$i<=$month_n;$i++)
        {
            $monthjs[$i]='tháng '.$i;
            $dayjs[$i] = $i;
            $numberjs[$i]=Order::where('status_order',2)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_n)->sum('total');
            $get = Order::where('status_order',2)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_n)->get();
            $count[$i] = count($get);
        }
        
        foreach($numberjs as $key1 => $value1){
            $key = '2021-'.$key1;
            $chart_data[$key]['sales'] = $value1;
        }
        
        foreach($count as $key2 => $value2){
            $key = '2021-'.$key2;
            $chart_data[$key]['total'] = $value2;
        }
        
        foreach($chart_data as $key => $val){
            $data[] = array(
                'date' => $key,
                'sales' => $val['sales'],
                'total' => $val['total'],
            );
        }
        echo json_encode($data);
    }

    public function getChartDonut(){
       
        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('d');
        
        $totalOrder = Order::whereDate('created_at', Carbon::today())->get();
        
        $totalOrderSuccess = Order::where('status_order','2')->whereDate('created_at', Carbon::today())->get();
        $totalOrderFail = Order::where('status_order','3')->whereDate('created_at', Carbon::today())->get();
        $totalOrderWaiting = Order::where('status_order','0')->whereDate('created_at', Carbon::today())->get();
        $totalOrderShipping = Order::where('status_order','1')->whereDate('created_at', Carbon::today())->get();
        $countTotalOrder =  count($totalOrder);
        $counttotalOrderSuccess =  count($totalOrderSuccess);
        $counttotalOrderFail =  count($totalOrderFail);
        $counttotalOrderWaiting =  count($totalOrderWaiting);
        $counttotalOrderShipping =  count($totalOrderShipping);

        $arr = [
            'Tổng đơn hàng' => $countTotalOrder,
            'Tổng đơn hàng thành công' => $counttotalOrderSuccess,
            'Tổng đơn hàng thất bại' =>$counttotalOrderFail,
            'Tổng đơn hàng đang chờ' =>$counttotalOrderWaiting,
            'Tổng đơn hàng đang vận chuyển' =>$counttotalOrderShipping
        ];
        $i = 0;
        foreach($arr as $key => $val){
            $data[$i] = array(
                'label' => $key,
                'value' => $val,
            );
            $i++;
        }
        
        echo json_encode($data);
    }

    public function getChartDonutMonth(){
       
        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('m');
        
        $totalOrder = Order::whereMonth('created_at',$month_n)->get();
        $totalOrderSuccess = Order::where('status_order','2')->whereMonth('created_at',$month_n)->get();
        $totalOrderFail = Order::where('status_order','3')->whereMonth('created_at',$month_n)->get();
        $totalOrderWaiting = Order::where('status_order','0')->whereMonth('created_at',$month_n)->get();
        $totalOrderShipping = Order::where('status_order','1')->whereMonth('created_at',$month_n)->get();
        $countTotalOrder =  count($totalOrder);
        $counttotalOrderSuccess =  count($totalOrderSuccess);
        $counttotalOrderFail =  count($totalOrderFail);
        $counttotalOrderWaiting =  count($totalOrderWaiting);
        $counttotalOrderShipping =  count($totalOrderShipping);

        $arr = [
            'Tổng đơn hàng' => $countTotalOrder,
            'Tổng đơn hàng thành công' => $counttotalOrderSuccess,
            'Tổng đơn hàng thất bại' =>$counttotalOrderFail,
            'Tổng đơn hàng đang chờ' =>$counttotalOrderWaiting,
            'Tổng đơn hàng đang vận chuyển' =>$counttotalOrderShipping
        ];
        $i = 0;
        foreach($arr as $key => $val){
            $data[$i] = array(
                'label' => $key,
                'value' => $val,
            );
            $i++;
        }
        
        echo json_encode($data);
    }

    public function getChartDonutYear(){
       
        $year_n = Carbon::now()->format('Y');
        $month_n = Carbon::now()->format('Y');
        
        $totalOrder = Order::whereYear('created_at',$month_n)->get();
        $totalOrderSuccess = Order::where('status_order','2')->whereYear('created_at',$month_n)->get();
        $totalOrderFail = Order::where('status_order','3')->whereYear('created_at',$month_n)->get();
        $totalOrderWaiting = Order::where('status_order','0')->whereYear('created_at',$month_n)->get();
        $totalOrderShipping = Order::where('status_order','1')->whereYear('created_at',$month_n)->get();
        $countTotalOrder =  count($totalOrder);
        $counttotalOrderSuccess =  count($totalOrderSuccess);
        $counttotalOrderFail =  count($totalOrderFail);
        $counttotalOrderWaiting =  count($totalOrderWaiting);
        $counttotalOrderShipping =  count($totalOrderShipping);

        $arr = [
            'Tổng đơn hàng' => $countTotalOrder,
            'Tổng đơn hàng thành công' => $counttotalOrderSuccess,
            'Tổng đơn hàng thất bại' =>$counttotalOrderFail,
            'Tổng đơn hàng đang chờ' =>$counttotalOrderWaiting,
            'Tổng đơn hàng đang vận chuyển' =>$counttotalOrderShipping
        ];
        $i = 0;
        foreach($arr as $key => $val){
            $data[$i] = array(
                'label' => $key,
                'value' => $val,
            );
            $i++;
        }
        
        echo json_encode($data);
    }


}
