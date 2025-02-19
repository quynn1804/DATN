<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Iphone 16 Pro Max',
                'description' => 'Iphone 16 Pro Max với màn hình lớn và hiệu suất mạnh mẽ.',
                'price' => 10000000,
                'discount' => 1000000,
                'image' => 'smartphone_a.jpg',
                'status' => 1,
                'quantity' => 50, // Thêm số lượng
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Laptop GLC Gaming Utral',
                'description' => 'Laptop GLC Gaming Utral với cấu hình cao cấp và thiết kế mỏng nhẹ.',
                'price' => 25000000,
                'discount' => 2000000,
                'image' => 'laptop_b.jpg',
                'status' => 1,
                'quantity' => 30, // Thêm số lượng
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

    }
}
