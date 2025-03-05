<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('productVariant.product', 'productVariant.color', 'productVariant.capacity')
            ->get();

        return view('user.cart', compact('cartItems'));
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