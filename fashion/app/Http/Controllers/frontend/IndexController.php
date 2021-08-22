<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function getIndex(){
        return view('/frontend/index');
    }

    //
    public function getContact(){
        return view('/frontend/contact');
    }

    //
    public function getAbout(){
        return view('/frontend/about');
    }
}
