<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
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
        $newProducts = $this->productRepo->getNewProduct();
        $hotProducts = $this->productRepo->getHotProduct();
        return view('/frontend/index',['hotProducts' =>$hotProducts],['newProducts' => $newProducts]);
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
