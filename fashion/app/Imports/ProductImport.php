<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'     => $row[0],
            'category_id'     => $row[1],
            'price'    => $row[2], 
            'quantity' => $row[3],
            'info' => $row[4],
            'describe' => $row[5],
        ]);
    }
}
