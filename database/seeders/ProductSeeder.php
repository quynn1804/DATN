<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Lấy hoặc tạo danh mục 'Điện thoại'
        $category = Category::firstOrCreate(['name' => 'Điện thoại']);

        // Sản phẩm đơn (single)
        Product::create([
            'category_id' => $category->id,
            'name' => 'iPhone 15 Pro',
            'description' => 'iPhone 15 Pro với chip A17 Bionic mới nhất.',
            'price' => 30000000,
            'quantity' => 50,
            'images' => json_encode([
                'products/iphone15pro1.jpg',
                'products/iphone15pro2.jpg',
                'products/iphone15pro3.jpg',
            ]),
            'status' => true,
            'product_type' => 'single',
        ]);

        // Sản phẩm đơn (single)
        Product::create([
            'category_id' => $category->id,
            'name' => 'Samsung Galaxy S23',
            'description' => 'Samsung Galaxy S23 mạnh mẽ và thiết kế đẳng cấp.',
            'price' => 25000000,
            'quantity' => 40,
            'images' => json_encode([
                'products/galaxys23_1.jpg',
                'products/galaxys23_2.jpg',
            ]),
            'status' => true,
            'product_type' => 'single',
        ]);

        // Sản phẩm có biến thể (variant)
        Product::create([
            'category_id' => $category->id,
            'name' => 'iPhone 14 (nhiều phiên bản)',
            'description' => 'iPhone 14 với nhiều phiên bản màu sắc và dung lượng.',
            'price' => null,          // không có giá ở sản phẩm gốc
            'quantity' => null,       // không có số lượng ở sản phẩm gốc
            'images' => json_encode([
                'products/iphone14_1.jpg',
                'products/iphone14_2.jpg',
            ]),
            'status' => true,
            'product_type' => 'variant',
        ]);
    }
}
