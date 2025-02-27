<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'iPhone 15 Pro',
            'description' => 'iPhone 15 Pro với chip A17 Bionic mới nhất.',
            'price' => 30000000,
            'quantity' => 50,
            'image' => 'product/iphone15pro.jpg', // Đảm bảo ảnh có sẵn trong storage/app/public/products
            'status' => true,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S23',
            'description' => 'Samsung Galaxy S23 mạnh mẽ và thiết kế đẳng cấp.',
            'price' => 25000000,
            'quantity' => 40,
            'image' => 'product/galaxys23.jpg',
            'status' => true,
        ]);
    }
}
