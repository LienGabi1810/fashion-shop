<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="category";
    protected $fillable = ['name','parent_id','tag'];
    public $timestamps = false;

    public function product()
    {
        return $this->hasMany('App\models\Product', 'category_id', 'id');
    }
}
