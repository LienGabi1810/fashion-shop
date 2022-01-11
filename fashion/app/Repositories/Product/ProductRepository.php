<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Http\Requests\UploadRequest;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProduct()
    {
        return $this->model->select('name')->take(5)->get();
    }

    public function getHotProduct()
    {
        return $this->model->where('is_hightlight','like','1')->where('status','like','1')->where('quantity','>',0)->orderBy('created_at','DESC')->take(8)->get();
    }

    public function geDetailProduct($id)
    {
        return $product = $this->model->find($id);
    }


    public function getNewProduct()
    {
        return $this->model->where('quantity','>',0)->where('status','like','1')->orderBy('id','DESC')->take(8)->get();
    }

    public function postProduct($id, $r)
    {
        $product = $this->model->find($id);
        $fileName = $product['image'];
        if($r->hasFile('image'))
        {
            $imageProduct = 'IMAGE-PRODUCT'.time().$r->file('image')->getClientOriginalName();
            $filee = $r->image;
            $fileName = $filee->getClientOriginalName();
            $filee->move('uploads/products',$fileName);
        }
        $product = array(
            'name' => $r->name,
            'code' => $r->code,
            'image' => $fileName,
            'price' => $r->price,
            'status' => $r->status,
            'quantity' => $r->quantity,
            'is_hightlight' => $r->is_hightlight,
            'category_id' => $r->category_id,
            'info' => $r->info,
            'weight' =>  '1',
            'imensions' =>  '1',
            'materials' =>  '1',
            'color' =>  '1',
            'sizes' => '1',
            'describe' => $r->describe
        );
        
        if($id){
            return $this->model->where('id', $id)->update($product);
        }else{
            return $this->model->create($product);
        }
    }

    public function deleteProduct($id)
    {
        return $this->model->delete($id);
    }
}