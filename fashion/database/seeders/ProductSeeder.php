<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name' => 'Vest Nam cao cấp',
            'image' => '',
            'price' =>'100000',
            'status' =>  '1',
            'quantity' =>  '100',
            'is_hightlight' =>  '1',
            'category_id' =>  '1'
        ]);
    }
}
