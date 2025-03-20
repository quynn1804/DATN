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
}
