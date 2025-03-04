<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'user_id' => 3,
                'product_variant_id' => 1,
                'quantity' => 2,
                'price_at_time' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'product_variant_id' => 2,
                'quantity' => 1,
                'price_at_time' => 700000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'product_variant_id' => 2,
                'quantity' => 3,
                'price_at_time' => 800000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
