<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class SearchController extends Controller
{

   /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }
    public function getSearch(Request $r){
        $data['products'] = Product::where('name','like','%'.$r->search.'%')->where('quantity','>','0')->where('status','like','1')
                            ->get();
        $data['categories'] = $this->categoryRepo->getAllParentCategory();
        return view('frontend.product.product',$data);
    }
}
