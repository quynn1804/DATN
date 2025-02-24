<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Color;
use App\Models\Capacity;

class ProductVariantSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $colors = Color::all();
        $capacities = Capacity::all();

        foreach ($products as $product) {
            foreach ($colors as $color) {
                foreach ($capacities as $capacity) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'capacity_id' => $capacity->id,
                        'price' => $product->price + rand(500000, 2000000), // Tăng giá nhẹ theo biến thể
                        'stock' => rand(5, 20),
                    ]);
                }
            }
        }
    }
}
