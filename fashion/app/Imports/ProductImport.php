<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $row[1] = (int)$row[1];
        $row[2] = (int)$row[2];
        return new Product([
            'name'     => $row[0],
            'price'    => $row[1], 
            'quantity' => $row[2],
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function startRow(): int
    {
        return config('excel.imports.start_row'); // return 2;
    }
    
}
