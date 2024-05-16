<?php

namespace App\Livewire\Admin\Report;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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

    public function printPdfOrderReportDay(){
        $this->validate([
            'date_day_from' => 'required',
            'date_day_to' => 'required',
        ]);



        $orders = Order::with('detailOrder', 'customer', 'outlet')
        ->where(DB::raw("DATE(created_at)"), '>=', $this->date_day_from)
        ->where(DB::raw("DATE(created_at)"), '<=', $this->date_day_to)
        ->orderByRaw("FIELD(order_status, 'Completed', 'Cancelled') ASC")
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
        ->orderByRaw("FIELD(order_status, 'Completed', 'Cancelled') ASC")
        ->get();

            session(['orders' => $orders]);
        $this->reset('date_month_from', 'date_month_to');
            return redirect()->route('print-pdf-order-report-month');
    }

    public function printPdfOrderReportYear(){
        $this->validate([
            'date_year' => 'required',
        ]);

        $orders = Order::with('detailOrder', 'customer', 'outlet')
        ->where(DB::raw("YEAR(created_at)"), $this->date_year)
        ->orderByRaw("FIELD(order_status, 'Completed', 'Cancelled') ASC")
        ->get();

            session(['orders' => $orders]);
        $this->reset('date_year');
            return redirect()->route('print-pdf-order-report-year');
    }
}
