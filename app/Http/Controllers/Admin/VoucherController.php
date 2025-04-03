<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $vouchers = Voucher::when($search, function ($query, $search) {
            return $query->where('code', 'like', "%$search%");
        })->orderBy('id', 'desc')->paginate(10);

        return view('admin.vouchers.index', ['title' => 'Quản lý Voucher'],compact('vouchers', 'search'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric|min:1',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'is_active' => 'boolean',
        ]);

        Voucher::create($request->all());
        return redirect()->route('admin.vouchers.index')->with('success', 'Tạo voucher thành công');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric|min:1',
            'min_order_value' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'is_active' => 'boolean',
        ]);

        $voucher->update($request->all());
        return redirect()->route('admin.vouchers.index')->with('success', 'Cập nhật voucher thành công');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Xóa voucher thành công');
    }

    public function toggleStatus(Voucher $voucher)
    {
        $voucher->is_active = !$voucher->is_active;
        $voucher->save();
        return redirect()->route('admin.vouchers.index')->with('success', 'Cập nhật trạng thái thành công');
    }

    public function applyVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:vouchers,code',
            'order_total' => 'required|numeric|min:0',
        ]);

        $voucher = Voucher::where('code', $request->code)->where('is_active', 1)->first();

        if (!$voucher) {
            return response()->json(['error' => 'Voucher không hợp lệ hoặc đã hết hạn'], 400);
        }

        if ($voucher->min_order_value && $request->order_total < $voucher->min_order_value) {
            return response()->json(['error' => 'Giá trị đơn hàng không đủ để áp dụng voucher'], 400);
        }

        $discount = $voucher->discount_type === 'fixed' ? $voucher->discount_value : ($request->order_total * $voucher->discount_value / 100);

        if ($voucher->max_discount_amount) {
            $discount = min($discount, $voucher->max_discount_amount);
        }

        $newTotal = $request->order_total - $discount;

        return response()->json([
            'success' => 'Áp dụng voucher thành công',
            'discount' => $discount,
            'new_total' => $newTotal,
        ]);
    }
}
