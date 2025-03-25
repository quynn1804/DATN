<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Lấy ID của danh mục 'Điện thoại' (hoặc tạo nếu chưa có)
        $category = Category::firstOrCreate(['name' => 'Điện thoại']);

        Product::create([
            'category_id' => $category->id, // Gán ID danh mục
            'name' => 'iPhone 15 Pro',
            'description' => 'iPhone 15 Pro với chip A17 Bionic mới nhất.',
            'price' => 30000000,
            'quantity' => 50,
            'image' => 'product/iphone15pro.jpg',
            'status' => true,

        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Samsung Galaxy S23',
            'description' => 'Samsung Galaxy S23 mạnh mẽ và thiết kế đẳng cấp.',
            'price' => 25000000,
            'quantity' => 40,
            'image' => 'product/galaxys23.jpg',
            'status' => true,

        ]);
    }
}
