<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\addCategoryRequest;


class CategoryController extends Controller
{
     /**
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
     */
    protected $categoryRepo;
    protected $productRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getCategory(){
        $category = $this->categoryRepo->getAll();
        return view('/backend/category/category',['category' => $category]);
    }

    public function postCategory(addCategoryRequest $r){
        $category = $this->categoryRepo->postCategory('',$r);
        return redirect('/admin/category/')->with('thongbao','Thêm mới danh mục thành công');
    }
}
