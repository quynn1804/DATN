<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;
        $currentDate = Carbon::now()->toDateString();

        // Doanh thu hôm nay
        $todayRevenue = Order::whereDate('created_at', $currentDate)
            ->where('status', 'completed')
            ->sum('total_money');

        // Doanh thu tháng hiện tại
        $currentMonthRevenue = Order::whereMonth('created_at', $currentMonth)
            ->where('status', 'completed')
            ->sum('total_money');

        // Doanh thu tháng trước
        $lastMonthRevenue = Order::whereMonth('created_at', $lastMonth)
            ->where('status', 'completed')
            ->sum('total_money');

        // Tính phần trăm thay đổi
        $percentageChange = $lastMonthRevenue == 0 ? 0 : round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2);

        return view('admin.statistic.index', compact('todayRevenue', 'currentMonthRevenue', 'lastMonthRevenue', 'percentageChange', 'currentDate'));
    }

}
