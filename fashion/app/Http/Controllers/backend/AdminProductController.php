<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ImagesProduct;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

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
        // $product = Category::find(9)->name;
        // $Category = Product::where('status', '1')->Category;
        // dd($Category);
        //$products = $this->productRepo->getAll();
        $data['products'] = Product::paginate(10);
        return view('/backend/product/product',$data);
    }

    public function getAddProduct(){
        $data['category'] = Category::all();
        return view('/backend/product/add-product',$data);
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
        return redirect('/admin/product')->with('thongbao','???? th??m s???n ph???m th??nh c??ng');
    }

    public function getEditProduct($id){
        $product = $this->productRepo->find($id);
        $imageProduct = ImagesProduct::all()->where('product_id','like',$id)->take(1);
        $category = Category::all();
        return view('/backend/product/edit-product',['product' =>$product,'category'=>$category,'imageProducts'=>$imageProduct]);
    }

    public function postEditProduct(EditProductRequest $r, $id){
        $productUpdate = $this->productRepo->postProduct($id,$r);
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
        
        if(empty($fileName1)){
            $fileName1 = $r->image1;
        }
        if(empty($fileName2)){
            $fileName2 = $r->image2;
        }
        if(empty($fileName3)){
            $fileName3 = $r->image3;
        }

        $imagesProduct = ImagesProduct::where('product_id',$id)->first();
        $imagesProduct->images = '1';
        $imagesProduct->product_id = $id;
        $imagesProduct->images1 = $fileName1;
        $imagesProduct->images2 = $fileName2;
        $imagesProduct->images3 = $fileName3;
        $imagesProduct->save();
        return redirect('/admin/product')->with('thongbao','Ch???nh s???a s???n ph???m th??nh c??ng');
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        //$this->productRepo->deleteProduct($id);
        return redirect('/admin/product')->with('thongbao','X??a s???n ph???m th??nh c??ng');
    }

    public function importExportView()
    {
       return view('import');
    }

    public function export() 
    {
        return Excel::download(new ProductExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ProductImport,request()->file('file'));
           
        return back()->with('thongbao','Import s???n ph???m th??nh c??ng');
    }
}
