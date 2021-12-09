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
        $products = Product::all()->where('quantity','>',0)->where('status','like','1');
        $categories = $this->categoryRepo->getAllParentCategory();
        return view('/frontend/product/product',['products' =>$products],['categories' => $categories]);
    }

    /**
     * 
     */
    public function getProductDetail($id){
        $data['product'] = $this->productRepo->geDetailProduct($id);
        
        $data['imagesProduct'] = ImagesProduct::all()->where('product_id',$id)->first();
        return view('/frontend/product/product-detail',$data);
    }

    public function checkQty($id,$qty){
        $product = Product::find($id);
        if($qty > $product->quantity){
            return 'error';
        }
        else{
            return 'success';
        }
    }

    public function getProductCategory(Request $r, $category_id){
        $data['categories'] = $this->categoryRepo->getAllParentCategory();
        $data['products']  = Product::where('category_id','like',$category_id)->where('quantity','>','0')->where('status','like','1')->get();
        return view('/frontend/product/product',$data);
    }

}
