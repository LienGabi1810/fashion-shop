<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ImagesProduct;
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
        if($r->hasFile('image1'))
        {
            $imageProduct1 = 'IMAGE-PRODUCT'.time().$r->file('image1')->getClientOriginalName();
            $filee1 = $r->image1;
            $fileName1 = $filee1->getClientOriginalName();
            $filee1->move('uploads/products',$fileName1);
        }
        if($r->hasFile('image2'))
        {
            $imageProduct2 = 'IMAGE-PRODUCT'.time().$r->file('image2')->getClientOriginalName();
            $filee2 = $r->image2;
            $fileName2 = $filee2->getClientOriginalName();
            $filee2->move('uploads/products',$fileName2);
        }
        if($r->hasFile('image3'))
        {
            $imageProduct3 = 'IMAGE-PRODUCT'.time().$r->file('image3')->getClientOriginalName();
            $filee3 = $r->image3;
            $fileName3 = $filee3->getClientOriginalName();
            $filee3->move('uploads/products',$fileName3);
        }
        
        $imagesProduct = new ImagesProduct();
        $imagesProduct->images = '1';
        $imagesProduct->product_id = $products->id;
        $imagesProduct->images1 = $fileName1;
        $imagesProduct->images2 = $fileName2;
        $imagesProduct->images3 = $fileName3;
        $imagesProduct->save();
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
        $product = Product::find($id);
        $product->delete();
        //$this->productRepo->deleteProduct($id);
        return redirect('/admin/product')->with('thongbao','Xóa sản phẩm thành công');
    }
}
