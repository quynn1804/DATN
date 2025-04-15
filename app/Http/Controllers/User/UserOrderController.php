<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id()) // Chỉ lấy đơn hàng của user hiện tại
            ->with('orderDetails.product')
            ->firstOrFail();

        return view('user.order_detail', compact('order'));
    }
    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Chỉ cho phép hủy nếu trạng thái là 'pending' hoặc 'processing'
        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->with('error', 'Bạn không thể hủy đơn hàng này.');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('myAccount')->with('success', 'Đơn hàng đã được hủy.');
    }
}
