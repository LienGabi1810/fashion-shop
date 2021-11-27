<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\addCategoryRequest;
use App\Models\Category;

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
        //$category = $this->categoryRepo->getAll();
        $category = Category::all();
        return view('/backend/category/category',['category' => $category]);
    }

    public function postCategory(addCategoryRequest $r){
        $category = $this->categoryRepo->postCategory('',$r);
        return redirect('/admin/category/')->with('thongbao','Thêm mới danh mục thành công');
    }

    public function getEditCategory($id){
        $data['category']=category::all();
        $data['cate']=category::find($id);
        return view('/backend/category/edit-category',$data);
    }

    public function postEditCategory(Request $r){
        $id = $r->category_id;
        $category=category::find($id);
        $category->name=$r->name;
        $category->parent_id=$r->parent;
        $category->tag=$this->stripunicode(str_replace(" ","-",strtolower($r->name)));
        $category->save();
        return redirect('/admin/category/')->with('thongbao','Đã sửa thành công');
    }

    public function getDeleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/category')->with('thongbao','Xóa danh mục thành công');
    }

    function stripunicode($str){ 
        if(!$str) return false;
        $unicode = array('a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
                         'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                         'd'=>'đ','D'=>'Đ',
                         'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                         'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                         'i'=>'í|ì|ỉ|ĩ|ị',
                         'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
                         'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                         'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                         'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                         'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                         'y'=>'ý|ỳ|ỷ|ỹ|ỵ','Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ');
        foreach($unicode as $khongdau=>$codau) {
            $arr=explode("|",$codau);$str = str_replace($arr,$khongdau,$str);
        }
    return $str;
    }
}
