<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Toastr;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Color;
use App\Models\Capacity;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // tìm kiếm sp theo tên spsp
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // tìm kiếm sp theo danh mục
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        // Lọc theo loại sản phẩm (single hoặc variant)
        if ($request->has('product_type') && in_array($request->product_type, ['single', 'variant'])) {
            $query->where('product_type', $request->product_type);
        }

        $products = $query->with(['category', 'variants'])->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', ['title' => 'Quản lý sản phẩm'], compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('variants.color', 'variants.capacity', 'category')->findOrFail($id);
        $productVariants = $product->variants;
        $productVariantsByColor = $productVariants
            ->groupBy('color_id')
            ->map(function ($variants) {
                return $variants->first(); // lấy 1 biến thể đầu tiên mỗi màu (để hiển thị ảnh)
            });

        return view('admin.products.show', compact('product', 'productVariants', 'productVariantsByColor'));
    }

    public function create()
    {
        $colors = Color::all();
        $capacities = Capacity::all();
        $categories = Category::all();

        return view('admin.products.create', compact('colors', 'capacities', 'categories'));
    }

    public function store(Request $request)
    {
        $productType = $request->input('product_type');

        $validated = $request->validate([
            'product_type' => 'required|in:single,variant',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => $productType === 'single' ? 'required|string' : 'nullable|string', // kiểm tra loại sản phẩm
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $imagePaths[] = $image->storeAs('products', $filename, 'public');
            }
        }

        $productData = [
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'images' => $imagePaths,
            'status' => true,
            'product_type' => $productType
        ];

        if ($productType === 'single') {
            $request->validate([
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'color_id' => 'required|exists:colors,id',
                'capacity_id' => 'required|exists:capacities,id',
            ]);

            $productData['price'] = $request->price;
            $productData['quantity'] = $request->quantity;
        }

        $product = Product::create($productData);

        if ($productType === 'variant') {
            $request->validate([
                'variants.*.color_id' => 'required|exists:colors,id',
                'variants.*.capacity_id' => 'required|exists:capacities,id',
                'variants.*.price' => 'required|numeric',
                'variants.*.stock' => 'required|integer',
                'variants.*.description' => 'nullable|string', // Cho phép mô tả là null
                'variants.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            foreach ($request->variants as $index => $variantData) {
                $variantImages = [];

                if ($request->hasFile("variants.$index.images")) {
                    foreach ($request->file("variants.$index.images") as $imageFile) {
                        $filename = time() . '_' . $imageFile->getClientOriginalName();
                        $path = $imageFile->storeAs('variants', $filename, 'public');
                        $variantImages[] = $path;
                    }
                }

                $product->variants()->create([
                    'color_id' => $variantData['color_id'],
                    'capacity_id' => $variantData['capacity_id'],
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                    'description' => $variantData['description'] ?? null, // Sử dụng null nếu không có mô tả
                    'images' => $variantImages,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
    }
    // sửa lại update nhiều ảnh
    public function edit(Product $product)
    {
        $colors = Color::all();
        $capacities = Capacity::all();
        $categories = Category::all();
        $product->load('variants');

        return view('admin.products.edit', compact('product', 'colors', 'capacities', 'categories'));
    }
    //

    public function update(Request $request, Product $product)
    {
        $productType = $request->input('product_type');

        // Validate chung
        $validated = $request->validate([
            'product_type' => 'required|in:single,variant',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý ảnh sản phẩm chính (single)
        $imagePaths = $product->images ?? [];

        if ($request->hasFile('images')) {
            // Xóa ảnh cũ
            foreach ($imagePaths as $oldImg) {
                Storage::disk('public')->delete($oldImg);
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = Str::random(10) . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('products', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        $updateData = [
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'images' => $imagePaths,
            'product_type' => $productType,
            'status' => $request->status ?? $product->status,
        ];

        if ($productType === 'single') {
            $request->validate([
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
            ]);

            $updateData['price'] = $request->price;
            $updateData['quantity'] = $request->quantity;

            // Xóa tất cả biến thể nếu chuyển về single
            $product->variants()->delete();
        }

        $product->update($updateData);

        if ($productType === 'variant') {
            // Xóa price và quantity khi chuyển sang variant
            $product->update([
                'price' => null,
                'quantity' => null,
            ]);

            $request->validate([
                'variants.*.id' => 'nullable|exists:product_variants,id',
                'variants.*.color_id' => 'required|exists:colors,id',
                'variants.*.capacity_id' => 'required|exists:capacities,id',
                'variants.*.price' => 'required|numeric',
                'variants.*.stock' => 'required|integer',
                'variants.*.description' => 'nullable|string',
                'variants.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Lấy danh sách id biến thể từ request, loại bỏ biến thể đã xóa
            $variantIdsInRequest = collect($request->variants)->pluck('id')->filter()->all();

            // dd($variantIdsInRequest);

            if (!empty($variantIdsInRequest)) {
                $product->variants()->whereNotIn('id', $variantIdsInRequest)->delete();
            }

            // $product->variants()->whereNotIn('id', $variantIdsInRequest)->delete();


            // dd($request->variants);

            foreach ($request->variants as $index => $variantData) {
                $variantImages = [];

                // Xử lý ảnh mới upload của biến thể
                if ($request->hasFile("variants.$index.images")) {
                    foreach ($request->file("variants.$index.images") as $imageFile) {
                        $filename = Str::random(10) . '_' . $imageFile->getClientOriginalName();
                        $path = $imageFile->storeAs('variants', $filename, 'public');
                        $variantImages[] = $path;
                    }
                }

                // Nếu không upload ảnh mới thì giữ ảnh cũ
                if (empty($variantImages)) {
                    $variantImages = $variantData['old_images'] ?? [];
                } else {
                    // Nếu có ảnh mới, xóa ảnh cũ trên storage
                    if (!empty($variantData['old_images'])) {
                        foreach ($variantData['old_images'] as $oldImg) {
                            Storage::disk('public')->delete($oldImg);
                        }
                    }
                }

                if (!empty($variantData['id'])) {
                    // Update biến thể cũ
                    $variant = ProductVariant::find($variantData['id']);
                    if ($variant) {
                        $variant->color_id = $variantData['color_id'];
                        $variant->capacity_id = $variantData['capacity_id'];
                        $variant->price = $variantData['price'];
                        $variant->stock = $variantData['stock'];
                        $variant->description = $variantData['description'] ?? null;
                        $variant->images = $variantImages;
                        $variant->save();
                    }
                } else {
                    // Tạo mới biến thể
                    $product->variants()->create([
                        'color_id' => $variantData['color_id'],
                        'capacity_id' => $variantData['capacity_id'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'description' => $variantData['description'] ?? null,
                        'images' => $variantImages,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật!');
    }


    // sửa lại update nhiều ảnhảnh


    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã bị xóa!');
    }

    public function destroyVariant($id)
    {
        $variant = ProductVariant::find($id);

        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'Biến thể không tồn tại.']);
        }


        $variant->delete();

        return response()->json(['success' => true, 'message' => 'Xóa biến thể thành công.']);
    }

    public function topFavorites()
    {

        $topProducts = Product::topFavoriteProducts();
        return view('user.top_favorites', compact('topProducts'));
    }

    public function statisticalProduct(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $titleTotalPrice = 'Doanh thu hôm nay';

        if ($request->has(['start_date', 'end_date']) && (empty($startDate) || empty($endDate))) {
            Toastr::error('', 'Vui lòng nhập đầy đủ ngày bắt đầu và ngày kết thúc.');
            return back();
        }

        if (!empty($startDate) && !empty($endDate)) {
            if (strtotime($startDate) > strtotime($endDate)) {
                Toastr::error('', 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.');
                return redirect()->route('admin.statistical.products');
            }

            $titleTotalPrice = 'Doanh thu từ ' . date('d/m', strtotime($startDate)) . ' đến ' . date('d/m', strtotime($endDate));
        }

        $topProductSale = OrderDetail::with(['productVariant.product'])
            ->selectRaw('product_variant_id, SUM(quantity) as total_quantity, SUM(total_price) as total_revenue')
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereHas('order', function ($q2) use ($startDate, $endDate) {
                    $q2->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                });
            })
            ->groupBy('product_variant_id')
            ->orderByDesc('total_revenue')
            ->limit(3)
            ->get();

        $lowSaleProducts = ProductVariant::with('product')
            ->select('product_variants.*')
            ->selectSub(function ($query) {
                $query->from('order_details')
                    ->selectRaw('COALESCE(SUM(quantity), 0)')
                    ->whereColumn('order_details.product_variant_id', 'product_variants.id');
            }, 'total_sold')
            ->orderBy('total_sold', 'asc')
            ->limit(3)
            ->get();
        $productStats = OrderDetail::selectRaw('
        products.name as product_name,
        SUM(order_details.total_price) as total_revenue,
        CONCAT("Số lượng: ", SUM(order_details.quantity), ", Doanh thu: ", FORMAT(SUM(order_details.total_price), 0)) as summary
    ')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereHas('order', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                });
            })
            ->groupBy('products.name')
            ->orderByDesc(DB::raw('SUM(order_details.total_price)'))
            ->get();

        $foodNames = $productStats->pluck('product_name');
        $foodRevenues = $productStats->pluck('total_revenue')->map(fn($val) => round($val))->toArray();
        $foodSummaries = $productStats->pluck('summary');

        /**
         * Sản phẩm sắp hết hàng (dưới 10 sản phẩm)
         */
        // $lowStockProducts = Product::with(['variants' => function ($q) {
        //     $q->where('stock', '<=', 10);
        // }])->where(function ($query) {
        //     $query->where('product_type', 'single')->where('quantity', '<=', 10)
        //         ->orWhere(function ($q) {
        //             $q->where('product_type', 'variant')->whereHas('variants', function ($variantQuery) {
        //                 $variantQuery->where('stock', '<=', 10);
        //             });
        //         });
        // })->get();
        $lowStockProducts = Product::whereHas('variants', function ($query) {
            $query->where('stock', '<=', 10);
        })
            ->with(['variants' => function ($query) {
                $query->where('stock', '<=', 10); // nếu muốn chỉ lấy các biến thể sắp hết hàng
            }])
            ->get();

        /**
         * Tổng số sản phẩm được active
         */
        $countProduct = Product::query()->where('status', 1)->count();
        /**
         * Tổng số danh mục sản phẩm
         */
        $countCategory = Category::query()->where('is_active', 1)->count();
        /**
         * Tổng số đơn hàng chưa xử lý
         */
        $countOrderPending = Order::query()->where('status', 'pending')->count();
        /**
         * Tổng số đơn hàng giao thành công
         */
        $countOrderCompleted = Order::query()->where('status', 'completed')->count();
        /**
         * Doanh thu hôm nay hoặc theo ngày xx -> ngày xx
         */

        $totalPriceOrderQuery = Order::query()->where('status', 'completed');

        if (!empty($startDate) && !empty($endDate)) {
            $totalPriceOrderQuery->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        } else {
            // Nếu không, mặc định là ngày hôm nay
            $totalPriceOrderQuery->whereDate('created_at', Carbon::today());
        }

        $totalPriceOrder = $totalPriceOrderQuery->sum('total_money');

        return view('admin.statistical.products', compact('startDate', 'endDate', 'topProductSale', 'foodNames', 'foodRevenues', 'foodSummaries', 'lowStockProducts', 'countProduct', 'countCategory', 'countOrderPending', 'countOrderCompleted', 'titleTotalPrice', 'totalPriceOrder', 'lowSaleProducts'));
    }
}
