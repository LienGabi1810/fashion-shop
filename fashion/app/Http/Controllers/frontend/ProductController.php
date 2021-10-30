<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImagesProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductController extends Controller
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

    /**
     * 
     */
    public function getProduct(){
        // $products = $this->productRepo->getAll();
        // dd($products);
        $products = Product::all();
        $categories = $this->categoryRepo->getAllParentCategory();
        return view('/frontend/product/product',['products' =>$products],['categories' => $categories]);
    }

    /**
     * 
     */
    public function getProductDetail($id){
        $product = $this->productRepo->geDetailProduct($id);
        
        $imagesProduct = ImagesProduct::all()->where('product_id',$id)->first();
        return view('/frontend/product/product-detail',['product' =>$product],['imagesProduct' => $imagesProduct]);
    }
}
