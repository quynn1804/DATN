<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // private const PATH_VIEW = 'admin.statistic.index';
    private const PATH_VIEW = 'admin.index';
    public function index(Request $request)
    {
        $selectedDay    = $request->input('date', now()->toDateString());
        $selectedMonth  = $request->input('month', now()->month);
        $selectedYear   = $request->input('year', now()->year);

        $years = $this->getDistinctYears();

        if (!$years->contains($selectedYear)) {
            return redirect()->route('admin.dashboard');
        }

        $dailyRevenue = $this->getDailyRevenue($selectedDay);
        $monthlyRevenue = $this->getMonthlyRevenue($selectedMonth, $selectedYear);
        $previousRevenue = $this->getPreviousDayRevenue($selectedDay);
        $previousRevenueMonth = $this->getPreviousMonthRevenue($selectedMonth, $selectedYear);
        $countUser = $this->getUserCountByRole(2);
        $orderCountByMonth = $this->getOrderCountByMonth($selectedMonth, $selectedYear);
        $orderCountPreviousMonth = $this->getOrderCountPreviousMonth($selectedMonth, $selectedYear);

        $monthlyData = $this->getMonthlyData($selectedYear);
        $monthlyRevenues = collect($monthlyData)->pluck('total_money')->toArray();
        $monthlyOrderCounts = collect($monthlyData)->pluck('order_count')->toArray();
        $monthlyRevenues = array_map('floatval', $monthlyRevenues);

        $orderStatusData = $this->getOrderStatusData($selectedYear);

        $orderStatusPayment = $this->getOrderPaymentMethod($selectedYear);

        return view(
            self::PATH_VIEW,
            compact(
                'selectedDay',
                'selectedMonth',
                'selectedYear',
                'years',
                'dailyRevenue',
                'monthlyRevenue',
                'previousRevenue',
                'previousRevenueMonth',
                'countUser',
                'orderCountByMonth',
                'orderCountPreviousMonth',
                'monthlyRevenues',
                'monthlyOrderCounts',
                'orderStatusData',
                'orderStatusPayment'
            )
        );
    }

    protected function getDistinctYears()
    {
        return DB::table('orders')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    }

    protected function getDailyRevenue($date)
    {
        return Order::where('status', 'completed')
            ->whereDate('created_at', $date)
            ->sum('total_money');
    }

    protected function getMonthlyRevenue($month, $year)
    {
        return Order::where('status', 'completed')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('total_money');
    }

    protected function getPreviousDayRevenue($date)
    {
        $previousDay = \Carbon\Carbon::parse($date)->subDay()->toDateString();

        return Order::where('status', 'completed')
            ->whereDate('created_at', $previousDay)
            ->sum('total_money');
    }

    protected function getPreviousMonthRevenue($month, $year)
    {
        $previousMonth = $month - 1;
        $previousYear = $year;

        if ($previousMonth == 0) {
            $previousMonth = 12;
            $previousYear -= 1;
        }

        return Order::where('status', 'completed')
            ->whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->sum('total_money');
    }

    protected function getUserCountByRole($roleId)
    {
        return User::where('role_id', $roleId)->count();
    }

    protected function getOrderCountByMonth($month, $year)
    {
        return Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    protected function getOrderCountPreviousMonth($month, $year)
    {
        $previousMonthDate = Carbon::createFromDate($year, $month, 1)->subMonth();
        $previousMonth = $previousMonthDate->month;
        $previousYear = $previousMonthDate->year;

        return Order::whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->count();
    }

    protected function getMonthlyData($year)
    {
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $orders = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', 'completed');

            $data[] = [
                'month' => $month,
                'total_money' => $orders->sum('total_money') ?: 0,
                'order_count' => $orders->count() ?: 0,
            ];
        }

        return $data;
    }

    protected function getOrderStatusData($year)
    {
        $totalOrders = DB::table('orders')
            ->whereYear('created_at', $year)
            ->count();

        $statusCounts = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->get();

        $statusNamesVi = [
            'pending'    => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipping'   => 'Đang giao hàng',
            'shipped'   => 'Đã giao hàng',
            'completed'  => 'Hoàn thành',
            'cancelled'  => 'Đã hủy',
        ];

        $statusColors = [
            'pending'    => '#FFD700',
            'processing' => '#4CAF50',
            'shipping'   => '#2196F3',
            'shipped'   =>  '#FF9800',
            'completed'  => '#9C27B0',
            'cancelled'  => '#F44336',
        ];

        $orderStatusData = [];

        foreach ($statusCounts as $item) {
            $percentage = ($totalOrders > 0) ? ($item->count / $totalOrders) * 100 : 0;
            $orderStatusData[] = [
                'name'  => $statusNamesVi[$item->status] ?? $item->status,
                'y'     => round($percentage, 2),
                'color' => $statusColors[$item->status] ?? '#888888',
            ];
        }

        return $orderStatusData;
    }

    public function getOrderPaymentMethod($year)
    {
        $paymentCounts = DB::table('orders')
            ->select('payment_method', DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('payment_method')
            ->get()
            ->keyBy('payment_method');

        $paymentMethodNames = [
            'cash'  => 'Thanh toán nhận hàng',
            'VNPay' => 'VNPay',
            'MoMo'  => 'MoMo',
        ];

        $paymentMethodColors = [
            'cash'  => '#ff9800',
            'VNPay' => '#4caf50',
            'MoMo'  => '#00b0ff',
        ];

        $totalOrders = $paymentCounts->sum('count');

        $orderStatusPaymentData = [];

        foreach ($paymentMethodNames as $key => $label) {
            $count = $paymentCounts[$key]->count ?? 0;
            $percentage = $totalOrders > 0 ? ($count / $totalOrders) * 100 : 0;

            $orderStatusPaymentData[] = [
                'name' => $label,
                'y' => round($percentage, 2),
                'color' => $paymentMethodColors[$key] ?? '#888888',
            ];
        }

        return $orderStatusPaymentData;
    }
}
