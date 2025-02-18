<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Smartphone A',
                'description' => 'Smartphone A với màn hình lớn và hiệu suất mạnh mẽ.',
                'price' => 10000000,
                'image' => 'smartphone_a.jpg',
                'category' => 'Điện thoại',
                'status' => 1,
                'discount' => 1000000
            ],
            [
                'name' => 'Laptop B',
                'description' => 'Laptop B với cấu hình cao cấp và thiết kế mỏng nhẹ.',
                'price' => 25000000,
                'image' => 'laptop_b.jpg',
                'category' => 'Laptop',
                'status' => 1,
                'discount' => 2000000
            ]
        ]);
    }
}
