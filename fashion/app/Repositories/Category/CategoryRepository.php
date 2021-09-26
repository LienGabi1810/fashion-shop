<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCategory()
    {
        return $this->model->select('name')->take(5)->get();
    }

    public function postCategory($id, $r)
    {
        $category = array(
            'name' => $r->name,
            'parent_id' => $r->parent_id,
        );
        if(!$r->id){
            return $this->model->create($category);
        }
    }
}