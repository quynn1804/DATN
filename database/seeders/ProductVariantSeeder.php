<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Color;
use App\Models\Capacity;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ProductVariantSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ để tránh bị trùng lặp khi chạy lại seeder
        Schema::disableForeignKeyConstraints();
        ProductVariant::truncate();
        Schema::enableForeignKeyConstraints();

        $products = Product::all();
        $colors = Color::all();
        $capacities = Capacity::all();

        // Đảm bảo có đủ dữ liệu trước khi chạy vòng lặp
        if ($products->isEmpty() || $colors->isEmpty() || $capacities->isEmpty()) {
            $this->command->warn('Thiếu dữ liệu sản phẩm, màu sắc hoặc dung lượng. Hãy seed các bảng trước.');
            return;
        }

        // Tạo biến thể sản phẩm bằng cách kết hợp tất cả sản phẩm, màu và dung lượng
        foreach ($products as $product) {
            foreach ($colors as $color) {
                foreach ($capacities as $capacity) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'capacity_id' => $capacity->id,
                        'price' => $product->price + rand(500000, 2000000), // Giá biến thể ngẫu nhiên
                        'stock' => rand(5, 20),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }

        
    }
}
