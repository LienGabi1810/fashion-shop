<?php

namespace Database\Seeders;

use Dotenv\Util\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lien gabi',
            'email' => 'honglien@gmail.com',
            'password' => '123456',
            'phone' =>  '0942379525',
            'address' =>  'Trâu quỳ-gia lâm',
            'gender' =>  '2',
            'role' =>  '1',
        ]);
    }
}
