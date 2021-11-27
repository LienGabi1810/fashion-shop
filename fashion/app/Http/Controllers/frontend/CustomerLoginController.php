<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Auth\SessionGuard;

class CustomerLoginController extends Controller
{
    public function getLogin(){
        return view('frontend.login');
    }

    public function postLogin(Request $r){
        $login = [
            'username' => $r->username,
            'password' => $r->password
        ];
        if (Auth::guard('customer')->attempt($login)) {
            $r->session()->regenerate();
            return redirect('/');
        } else {
            return back()->with('status', 'Email hoặc Password không chính xác');
        }
    }   

    public function getRegister(){
        return view('frontend.register');
    }

    public function postRegister(Request $r){
        if($r->password != $r->repeatpassword){
            return back()->with('thongbao','Nhập lại mật khẩu không chính xác');
        }else{
            $customer = new Customer();
            $customer->username = $r->username;
            $customer->email = $r->email;
            $customer->password = bcrypt($r->password);
            $customer->save();
        }
        return redirect('/customerlogin')->with('thongbao','Đăng ký thành công');
    }

    public function getCustomerLogout(){
        //Auth::logout();
        Auth('customer')->logout();
        //auth()->logout
        return redirect()->intended('/');
    }
}
