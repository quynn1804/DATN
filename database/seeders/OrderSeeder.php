<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách user và sản phẩm
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        // Tạo 10 đơn hàng mẫu
        foreach (range(1, 10) as $index) {
            $order = Order::create([
                'order_code' => 'ORD' . strtoupper($faker->unique()->bothify('?????-#####')),
                'user_id' => $faker->randomElement($users),
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'total_money' => 0, // Sẽ cập nhật sau
                'payment_method' => $faker->randomElement(['cod', 'bank', 'paypal', 'momo']),
            ]);

            $total = 0;
            foreach (range(1, rand(1, 5)) as $i) {
                $product_id = $faker->randomElement($products);
                $price = Product::find($product_id)->price;
                $quantity = rand(1, 3);
                $total += $price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            // Cập nhật lại tổng tiền đơn hàng
            $order->update(['total_money' => $total]);
        }
    }
}
