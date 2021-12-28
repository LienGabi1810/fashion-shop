<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table="customer";
    protected $fillable = ['username','phone','address','email','password,name,order_id'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function orderDetail()
    {
        return $this->hasMany('App\models\Order_Detail', 'customer_id', 'id');
    }
}
