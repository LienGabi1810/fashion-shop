<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;

class IndexController extends Controller
{
    //

    /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getIndex(){
        $data['newProducts'] = $this->productRepo->getNewProduct();
        $data['hotProducts'] = $this->productRepo->getHotProduct();
        $data['categories'] = Category::where('parent_id','like','0')->take(3)->get();
        return view('/frontend/index',$data);
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
