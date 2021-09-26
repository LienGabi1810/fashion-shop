<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;


use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getProduct(){
        $products = $this->productRepo->getAll();
        return view('/backend/product/product',['products' =>$products]);
    }

    public function getAddProduct(){
        return view('/backend/product/add-product');
    }

    public function postProduct(AddProductRequest $r){
        $products = $this->productRepo->postProduct('',$r);
        return redirect('/admin/product')->with('thongbao','Đã thêm sản phẩm thành công');
    }

    public function getEditProduct($id){
        $product = $this->productRepo->find($id);
        return view('/backend/product/edit-product',['product' =>$product]);
    }

    public function postEditProduct(EditProductRequest $r, $id){
        $productUpdate = $this->productRepo->postProduct($id,$r);
        return redirect('/admin/product')->with('thongbao','Chỉnh sửa sản phẩm thành công');
    }

    public function deleteProduct($id){
        $this->productRepo->deleteProduct($id);
        return redirect('/admin/product')->with('thongbao','Xóa sản phẩm thành công');
    }
}
