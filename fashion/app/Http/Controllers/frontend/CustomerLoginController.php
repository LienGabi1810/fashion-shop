<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Auth\SessionGuard;
use Cart;

class CustomerLoginController extends Controller
{
    public function getLogin(){
        return view('frontend.login');
    }

    public function postLogin(LoginCustomerRequest $r){
        $login = [
            'username' => $r->username,
            'password' => $r->password
        ];
        if (Auth::guard('customer')->attempt($login)) {
            $r->session()->regenerate();
            return redirect('/');
        } else {
            return back()->with('thongbao', 'Username hoặc Password không chính xác');
        }
    }   

    public function getRegister(){
        return view('frontend.register');
    }

    public function postRegister(RegisterRequest $r){
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
        Cart::Destroy();
        //auth()->logout
        return redirect()->intended('/');
    }
}
