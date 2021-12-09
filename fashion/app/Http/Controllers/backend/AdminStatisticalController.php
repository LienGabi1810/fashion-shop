<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStatisticalController extends Controller
{
    public function getIndex(){
        return view('/backend/statistical');
    }
}
