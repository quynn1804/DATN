<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));


        $todayRevenue = Order::whereDate('created_at', today())->sum('total_money');
        $monthlyRevenue = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_money');
        $lastMonthRevenue = Order::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->sum('total_money');
        $growth = ($lastMonthRevenue > 0) ? (($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        // Thống kê tổng số đơn hàng & doanh thu
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_money');

        // Thống kê số lượng khách hàng đặt hàng
        $totalUsers = User::whereBetween('created_at', [$startDate, $endDate])->count();

        // Thống kê số lượng sản phẩm đã bán
        $totalProductsSold = DB::table('order_details')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('quantity');

        // Thống kê trạng thái đơn hàng
        $orderStatus = Order::select('status', DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('status')
            ->pluck('count', 'status');
            $orderStats = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get()
            ->pluck('total', 'date'); // Pluck để tạo array key-value

        // Top 5 sản phẩm bán chạy nhất
        $topProducts = DB::table('order_details')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();



        return view('admin.statistic.index', compact(
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'totalProductsSold',
            'orderStatus',
            'topProducts',
            'startDate',
            'endDate',
            'todayRevenue',
            'monthlyRevenue',
            'lastMonthRevenue',
            'growth',
            'orderStats'
        ));
    }
}
