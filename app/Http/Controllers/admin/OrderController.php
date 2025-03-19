<?php

namespace App\Http\Controllers\Admin;
use App\Models\Voucher;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng.
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        $query = Order::query();

        // Tìm kiếm theo mã đơn hàng hoặc tên khách hàng
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'LIKE', "%$search%")
                    ->orWhere('name', 'LIKE', "%$search%");
            });
        }

        // Lọc theo ngày
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        // Lọc theo tháng
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('created_at', $request->month);
        }

        // Lọc theo năm
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('created_at', $request->year);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết một đơn hàng.
     */
    public function show($id)
    {
        $order = Order::with('orderDetails.productVariant')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Tạo mới đơn hàng (nếu cần).
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'total_money' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'payment_method' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được tạo.');
    }

    /**
     * Cập nhật trạng thái đơn hàng.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật đơn hàng thành công.');
    }

    /**
     * Xóa đơn hàng.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã bị xóa.');
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'voucher_code' => 'nullable|string',
        ]);

        $orderTotal = $this->calculateOrderTotal();

        // Kiểm tra voucher
        $voucher = null;
        if ($request->voucher_code) {
            $voucher = Voucher::where('code', $request->voucher_code)->first();
            if (!$voucher || !$voucher->isValid($orderTotal)) {
                return back()->with('error', 'Mã giảm giá không hợp lệ');
            }
            $discount = $voucher->calculateDiscount($orderTotal);
            $orderTotal -= $discount;
        }

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $orderTotal,
            'voucher_id' => $voucher ? $voucher->id : null,
        ]);

        return redirect()->route('order.success', $order->id);
    }
}
