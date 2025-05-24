<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Mail\ReviewRequestMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReviewRequestEmail extends Command
{
    protected $signature = 'orders:send-review-reminder';
    protected $description = 'Gửi email đánh giá sau 3 ngày kể từ khi đơn hàng được giao';

    public function handle()
    {
        $orders = Order::where('status', 'shipped')
        ->where('updated_at', '<=', Carbon::now()->subDays(3) ) // CHUẨN
       ->get();                                                                                    // subMinutes(1) - settime 1'
                                                                                               // subDays(3) - setime 3 ngày
        if ($orders->isEmpty()) {
            $this->info("Không có đơn hàng nào đủ điều kiện.");
            return;
        }

        foreach ($orders as $order) {
            if (!$order->user || !$order->user->email) {
                Log::info("Order {$order->id} không có user hoặc email.");
                continue;
            }

            $email = $order->user->email;

            Mail::to($email)->send(new ReviewRequestMail($order));

            Log::info("Đã gửi mail đánh giá đơn hàng #{$order->id} đến {$email}");
            $this->info("Đã gửi mail cho đơn hàng #{$order->id} đến {$email}");
        }
    }
}
