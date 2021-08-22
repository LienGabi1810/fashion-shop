<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlog()
    {
        return view('/frontend/blog/blog');
    }

    public function getBlogDetail()
    {
        return view('/frontend/blog/blog-detail');
    }
}
