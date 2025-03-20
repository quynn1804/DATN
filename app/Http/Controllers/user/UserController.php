<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

use App\Models\Capacity;
use App\Models\Category;
use App\Models\Color;

use App\Models\Cart;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return View('user.home', compact('products'));
    }

    public function pageCategory()
    {
        $categories = Category::all();
        $products = Product::all();
        $Capacities = Capacity::all();
        $colors = Color::all();
        return view('user.pageCategory', compact('products','categories','Capacities','colors'));
    }

    public function login()
    {
        return view('user.login');
    }


    public function cart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('productVariant')->get();

        return view('user.cart', compact('cartItems'));

    }



    public function about()
    {
        return view('user.about');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function myAccount()
    {
        $user = Auth::user();

        // Lấy các đơn hàng của người dùng đang đăng nhập
        $orders = Order::where('user_id', $user->id)->paginate(5);

        return view('user.myAccount', compact('user', 'orders'));
    }



    public function singleProduct($id)
    {
        $product = Product::with(['variants.color', 'variants.capacity'])->findOrFail($id);
        $productt = Product::all();
        // Lấy danh sách màu sắc và dung lượng
        $colors = $product->variants->pluck('color')->unique('id');
        $capacities = $product->variants->pluck('capacity')->unique('id');


        return view('user.singleProduct', compact('product', 'colors', 'capacities','productt'));

    }


    // Hàm tìm kiếm sp
    public function search(Request $request)
  {
    $keyword = $request->input('q'); // Lấy từ khóa tìm kiếm từ input

    $products = Product::where('name', 'LIKE', "%$keyword%")
        ->orWhere('description', 'LIKE', "%$keyword%")
        ->get();

    return view('user.search', compact('products', 'keyword'));
   }

}

