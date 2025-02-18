<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variations')->insert([
            // Smartphone A
            ['product_id' => 1, 'type' => 'color', 'value' => 'Đỏ'],
            ['product_id' => 1, 'type' => 'color', 'value' => 'Xanh'],
            ['product_id' => 1, 'type' => 'capacity', 'value' => '64GB'],
            ['product_id' => 1, 'type' => 'capacity', 'value' => '128GB'],

            // Laptop B
            ['product_id' => 2, 'type' => 'color', 'value' => 'Bạc'],
            ['product_id' => 2, 'type' => 'capacity', 'value' => '256GB'],
            ['product_id' => 2, 'type' => 'capacity', 'value' => '512GB'],
        ]);
    }
}
