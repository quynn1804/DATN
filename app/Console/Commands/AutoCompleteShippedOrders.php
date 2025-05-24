<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class AutoCompleteShippedOrders extends Command
{
    protected $signature = 'orders:auto-complete-shipped';
    protected $description = 'Tự động chuyển trạng thái đơn hàng từ shipped sang completed nếu đã qua 30 giây';

    public function handle()
    {
        $threshold = Carbon::now()->subDays(7);  // subDays(7) -> settime 7day
                                                         // subSeconds(30)  -> settime 30s
                                                         // subMinutes(1) - settime 1'
        $orders = Order::where('status', 'shipped')
            ->where('updated_at', '<=', $threshold)
            ->get();

        foreach ($orders as $order) {
            $order->status = 'completed';
            $order->save();
            $this->info("Order ID {$order->id} đã chuyển sang trạng thái completed.");
        }

        return 0;
    }
}
