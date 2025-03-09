<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ProductVariant;

class CartSeeder extends Seeder
{
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        DB::table('carts')->truncate();

        // Lấy danh sách user hợp lệ
        $users = User::pluck('id')->toArray();
        if (empty($users)) {
            $this->call(UserSeeder::class);
            $users = User::pluck('id')->toArray();
        }

        // Lấy danh sách product_variant_id
        $productVariants = ProductVariant::pluck('id')->toArray();
        if (empty($productVariants)) {
            $this->call(ProductVariantSeeder::class);
            $productVariants = ProductVariant::pluck('id')->toArray();
        }

        // Kiểm tra lại nếu vẫn không có dữ liệu thì thoát
        if (empty($users) || empty($productVariants)) {
            $this->command->warn('Không có dữ liệu user hoặc product variant để seed vào giỏ hàng!');
            return;
        }

        // Chèn dữ liệu vào bảng carts
        DB::table('carts')->insert([
            [
                'user_id' => $users[0], // Đảm bảo user_id hợp lệ
                'product_variant_id' => $productVariants[0], // Đảm bảo variant_id hợp lệ
                'quantity' => 2,
                'price_at_time' => 500000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $users[0],
                'product_variant_id' => $productVariants[1] ?? $productVariants[0], // Tránh lỗi nếu mảng không đủ phần tử
                'quantity' => 1,
                'price_at_time' => 700000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $users[0],
                'product_variant_id' => $productVariants[2] ?? $productVariants[0],
                'quantity' => 3,
                'price_at_time' => 800000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
