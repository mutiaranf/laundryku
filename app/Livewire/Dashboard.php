<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Income;
use App\Models\Outlet;
use App\Models\Expense;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\CashBalance;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class Dashboard extends Component
{

    public function render()
    {

        $employeeId = auth()->user()->employee_id;
        $employee = Employee::where('id', $employeeId)->first();
        $outletId = $employee->outlet_id ?? null;
        $CashBalance = CashBalance::where('outlet_id', $outletId)->first();
        $income = Income::where('outlet_id', $outletId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');
        $expense = Expense::where('outlet_id', $outletId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');
        $profit = $income - $expense;
        $customer_count = Order::distinct('customer_id')->count('customer_id');
        $order_count = Order::where('outlet_id', $outletId)->count();
        $recent_orders = Order::with('customer')->where('outlet_id', $outletId)->latest()->take(5)->get();

        $totalCashBalance = CashBalance::sum('amount');
        $totalIncome = Income::sum('amount');
        $totalExpense = Expense::sum('amount');
        $totalProfit = $totalIncome - $totalExpense;
        $totalCustomerCount = Customer::count();
        $totalOrderCount = Order::count();
        $totalOutletCount = Outlet::count();
        $totalEmployeeCount = Employee::count();
        $recent_completed_orders = Order::with('customer')->where('order_status', 'completed')->latest()->take(5)->get();

        $grafikMonthAdmin = [];
        $grafikStatusCompletedAdmin = [];
        $grafikStatusCancelledAdmin = [];

        // order recap with data : count order cancelled, order processed, order completed by month
        $ordersRecapAdministrator = Order::selectRaw('MONTHNAME(created_at) as month,
          SUM(CASE WHEN order_status = "completed" THEN 1 ELSE 0 END) as completed,
          SUM(CASE WHEN order_status = "processed" THEN 1 ELSE 0 END) as processed,
          SUM(CASE WHEN order_status = "cancelled" THEN 1 ELSE 0 END) as cancelled')

            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();
        foreach ($ordersRecapAdministrator as $order) {
            $grafikMonthAdmin[] = $order->month;
            $grafikStatusCompletedAdmin[] = $order->completed;
            $grafikStatusCancelledAdmin[] = $order->cancelled;
        }


        $grafikMonthSupervisor = [];
        $grafikStatusCompletedSupervisor = [];
        $grafikStatusCancelledSupervisor = [];
        // order recap with data : count order cancelled, order processed, order completed by month
        $ordersRecapSupervisor = Order::selectRaw('MONTHNAME(created_at) as month,
          SUM(CASE WHEN order_status = "completed" THEN 1 ELSE 0 END) as completed,
          SUM(CASE WHEN order_status = "processed" THEN 1 ELSE 0 END) as processed,
          SUM(CASE WHEN order_status = "cancelled" THEN 1 ELSE 0 END) as cancelled')
            ->where('outlet_id', $outletId)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();
            foreach ($ordersRecapSupervisor as $order) {
                $grafikMonthSupervisor[] = $order->month;
                $grafikStatusCompletedSupervisor[] = $order->completed;
                $grafikStatusCancelledSupervisor[] = $order->cancelled;
            }



        $orders = Order::with('detailOrder', 'customer')
            ->whereMonth('created_at', now()->month)
            ->orderByRaw("FIELD(order_status, 'Completed', 'Cancelled') ASC")
            ->paginate(5);

        return view('livewire.dashboard', compact('ordersRecapAdministrator', 'grafikMonthAdmin', 'grafikStatusCompletedAdmin', 'grafikStatusCancelledAdmin', 'CashBalance', 'income', 'expense', 'profit', 'customer_count', 'order_count', 'recent_orders', 'outletId', 'totalCashBalance', 'totalIncome', 'totalExpense', 'totalProfit', 'totalCustomerCount', 'totalOrderCount', 'totalOutletCount', 'totalEmployeeCount', 'recent_completed_orders', 'orders'));
    }
}
