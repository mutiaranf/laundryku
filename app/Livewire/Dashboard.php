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
        $order_count = Order::where('outlet_id',$outletId)->count();
        $recent_orders = Order::with('customer')->where('outlet_id',$outletId)->latest()->take(5)->get();

        $totalCashBalance = CashBalance::sum('amount');
        $totalIncome = Income::sum('amount');
        $totalExpense = Expense::sum('amount');
        $totalProfit = $totalIncome - $totalExpense;
        $totalCustomerCount = Customer::count();
        $totalOrderCount = Order::count();
        $totalOutletCount = Outlet::count();
        $totalEmployeeCount = Employee::count();
        $recent_completed_orders = Order::with('customer')->where('order_status','completed')->latest()->take(5)->get();

        return view('livewire.dashboard', compact('CashBalance', 'income', 'expense', 'profit','customer_count','order_count', 'recent_orders','outletId','totalCashBalance','totalIncome','totalExpense','totalProfit','totalCustomerCount','totalOrderCount','totalOutletCount','totalEmployeeCount','recent_completed_orders'));
    }
}
