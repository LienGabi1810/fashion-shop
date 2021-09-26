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