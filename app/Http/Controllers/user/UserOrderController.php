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
    public function confirmReceived($id)
{
    $order = Order::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('status', 'shipping')
        ->first();

    if (!$order) {
        return redirect()->back()->with('error', 'Không thể xác nhận đơn hàng.');
    }

    $order->status = 'completed';
    $order->save();

    return redirect()->back()->with('success', 'Bạn đã xác nhận đã nhận hàng. Cảm ơn bạn!');
}

}
