<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    use HasFactory;
    protected $table="images_product";

    public function product()
    {
        return $this->hasOne('App\models\Product', 'product_id', 'id');
    }
}
