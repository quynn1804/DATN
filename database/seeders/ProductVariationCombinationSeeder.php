<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductVariationCombinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variation_combinations')->insert([
            // Smartphone A
            [
                'product_id' => 1,
                'color_id' => 1, // Đỏ
                'capacity_id' => 1, // 64GB
                'price' => 10000000,
                'stock' => 100
            ],
            [
                'product_id' => 1,
                'color_id' => 2, // Xanh
                'capacity_id' => 2, // 128GB
                'price' => 12000000,
                'stock' => 150
            ],

            // Laptop B
            [
                'product_id' => 2,
                'color_id' => 3, // Bạc
                'capacity_id' => 3, // 256GB
                'price' => 25000000,
                'stock' => 50
            ],
            [
                'product_id' => 2,
                'color_id' => 3, // Bạc
                'capacity_id' => 4, // 512GB
                'price' => 28000000,
                'stock' => 30
            ]
        ]);
    }
}
