<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getProduct();

    public function getHotProduct();

    public function getNewProduct();

    public function geDetailProduct($id);

    public function postProduct($id, $arr);

    public function deleteProduct($id);
}