<?php

namespace App\Http\Controllers\user;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('productVariant.product', 'productVariant.color', 'productVariant.capacity')
            ->get();

        return view('user.cart', compact('cartItems'));
    }
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|exists:colors,id',
            'capacity_id' => 'nullable|exists:capacities,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Tìm biến thể sản phẩm phù hợp
        $variant = ProductVariant::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('capacity_id', $request->capacity_id)
            ->first();

        if (!$variant) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Không tìm thấy biến thể phù hợp.');
        }

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($cartItem) {
            // Nếu đã có trong giỏ hàng, cập nhật số lượng
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có, tạo mới
            Cart::create([
                'user_id' => Auth::id(),
                'product_variant_id' => $variant->id,
                'quantity' => $request->quantity,
                'price_at_time' => $variant->price,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng!']);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $newTotal = $cartItem->price_at_time * $cartItem->quantity;
        $totalCart = Cart::where('user_id', auth()->id())->sum(DB::raw('quantity * price_at_time'));

        return response()->json([
            'success' => true,
            'new_total' => number_format($newTotal, 0, ',', '.'),
            'total_cart' => number_format($totalCart, 0, ',', '.')
        ]);
    }


    public function destroy($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công.');
    }
}
?>
