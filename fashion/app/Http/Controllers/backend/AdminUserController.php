<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    public function getUser(){
        return view('/backend/user/user');
    }


    public function getAddUser(){
        return view('/backend/user/add-user');
    }
}
