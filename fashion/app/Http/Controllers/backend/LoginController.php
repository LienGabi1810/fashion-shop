<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function getLogin(){
        return view('backend/login');
    }

    public function postLogin(LoginRequest $r){
        $arr = [
            'email' => $r->email,
            'password' => $r->password
        ];

        if (Auth::attempt($arr)){
            $r->session()->regenerate();
            return redirect()->intended('/admin');
        }else{
            return back()->with('thongbao','Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->intended('/login');
    }
}
