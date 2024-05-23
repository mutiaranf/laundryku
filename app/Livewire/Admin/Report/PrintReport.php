<?php

namespace App\Livewire\Admin\Report;

use App\Models\Order;
use Livewire\Component;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\DB;
use App\Exports\OrdersByYearExport;
use App\Exports\OrdersByMonthExport;

class PrintReport extends Component
{
    public function render()
    {
        return view('livewire.admin.report.print-report');
    }
    public $date_day_from;
    public $date_day_to;

    public $date_month_from;
    public $date_month_to;

    public $date_year;

    public function printExcelOrderReportDay(){
        $this->validate([
            'date_day_from' => 'required',
            'date_day_to' => 'required',
        ]);

        return (new OrdersExport)->byBetweenDate($this->date_day_from, $this->date_day_to)->download('orders-by-day.xlsx');
    }

    public function printExcelOrderReportMonth(){
        $this->validate([
            'date_month_from' => 'required',
            'date_month_to' => 'required',
        ]);

        return (new OrdersByMonthExport)->byBeetweenMonth($this->date_month_from, $this->date_month_to)->download('orders-by-month.xlsx');
    }

    public function printExcelOrderReportYear(){
        $this->validate([
            'date_year' => 'required',
        ]);

        return (new OrdersByYearExport)->byYear($this->date_year)->download('orders-by-year.xlsx');
    }

    public function printPdfOrderReportDay(){
        $this->validate([
            'date_day_from' => 'required',
            'date_day_to' => 'required',
        ]);

        $orders = Order::with('detailOrder', 'customer', 'outlet')
        ->where(DB::raw("DATE(created_at)"), '>=', $this->date_day_from)
        ->where(DB::raw("DATE(created_at)"), '<=', $this->date_day_to)
        ->where('order_status','Completed')
        ->get();

            session(['orders' => $orders]);
        $this->reset('date_day_from', 'date_day_to');
            return redirect()->route('print-pdf-order-report-day');


    }

    public function printPdfOrderReportMonth(){
        $this->validate([
            'date_month_from' => 'required',
            'date_month_to' => 'required',
        ]);

        $orders = Order::with('detailOrder', 'customer', 'outlet')
        ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '>=', $this->date_month_from)
        ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '<=', $this->date_month_to)
        ->where('order_status','Completed')
        ->get();

            session(['orders' => $orders]);
        $this->reset();
            return redirect()->route('print-pdf-order-report-month');
    }

    public function printPdfOrderReportYear(){
        $this->validate([
            'date_year' => 'required',
        ]);

        $orders = Order::with('detailOrder', 'customer', 'outlet')
        ->where(DB::raw("YEAR(created_at)"), $this->date_year)
        ->where('order_status','Completed')
        ->get();

            session(['orders' => $orders]);
        $this->reset();
            return redirect()->route('print-pdf-order-report-year');
    }
}
