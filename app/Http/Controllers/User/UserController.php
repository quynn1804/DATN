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
        //tat ca sp
        $products = Product::all();
        //sp moi->theo ngay them
        $newProducts = Product::orderByDesc('created_at')
            ->limit(10)
            ->get();
        //sp noi bat->theo luot ban
        $topProducts = Product::withSum([
            'orderDetails as order_items_count' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            }
        ], 'quantity')
            ->orderByDesc('order_items_count')
            ->limit(10)
            ->get();

        return view('user.home', compact('products', 'newProducts', 'topProducts'));
    }

    public function pageCategory(Request $request)
    {
        $categories = Category::all();
        $Capacities = Capacity::all();
        $colors = Color::all();

        $query = Product::query();

        // Lọc theo danh mục
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo màu sắc
        if ($request->has('color_id') && $request->color_id) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('color_id', $request->color_id);
            });
        }

        // Lọc theo dung lượng
        if ($request->has('capacity_id') && $request->capacity_id) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('capacity_id', $request->capacity_id);
            });
        }

        // Lấy sản phẩm với phân trang (9 sản phẩm mỗi trang)
        $products = $query->paginate(9);

        return view('user.pageCategory', compact('products', 'categories', 'Capacities', 'colors'));
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
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('user.myAccount', compact('user', 'orders'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Cập nhật thông tin người dùng
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Nếu có mật khẩu mới, cập nhật mật khẩu
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật tài khoản thành công!');
    }


    public function singleProduct($id)
    {
        $product = Product::with(['variants.color', 'variants.capacity'])->findOrFail($id);
        $productt = Product::all();
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $id)
        ->get();
        // Lấy danh sách màu sắc và dung lượng
        $colors = $product->variants->pluck('color')->unique('id');
        $capacities = $product->variants->pluck('capacity')->unique('id');


        return view('user.singleProduct', compact('product', 'colors', 'capacities', 'productt','relatedProducts'));

    }


    // Hàm tìm kiếm sp
    public function search(Request $request)
    {
        $keyword = $request->input('q'); // Lấy từ khóa tìm kiếm từ input
        $prd = Product::all();
        $products = Product::where('name', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->get();

        return view('user.search', compact('products', 'keyword', 'prd'));
    }

}

