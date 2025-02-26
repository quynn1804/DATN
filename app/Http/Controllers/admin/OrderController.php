<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10); // Lấy danh sách đơn hàng, sắp xếp mới nhất
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public function show($id)
    {
        $order = Order::with('orderItems.product', 'statuses')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,canceled',
        ]);

        $order = Order::findOrFail($id);

        // Thêm trạng thái mới vào bảng order_statuses
        OrderStatus::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'note' => $request->note ?? null
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    /**
     * Xóa đơn hàng
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã bị xóa.');
    }
}
