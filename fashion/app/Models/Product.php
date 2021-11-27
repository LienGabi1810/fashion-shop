<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['name','image','price','status','quantity','is_hightlight','describe','info','code','category_id','code','weight','imensions','materials','color','sizes'];
    public function category()
    {
        return $this->belongsTo('App\models\Category', 'category_id', 'id');
    }
}
