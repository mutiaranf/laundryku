<?php

namespace App\Livewire\Supervisor\Report;

use App\Models\Order;
use Livewire\Component;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class PrintReportSupervisor extends Component
{

    public $outletId;
    public function __construct()
    {

        $this->outletId = Employee::find(auth()->user()->employee_id)->outlet_id;
    }
    public function render()
    {
        return view('livewire.supervisor.report.print-report-supervisor');
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
        ->where('outlet_id', $this->outletId)
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
        ->where('outlet_id', $this->outletId)
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
        ->where('outlet_id', $this->outletId)
        ->where('order_status','Completed')
        ->get();

            session(['orders' => $orders]);
        $this->reset();
            return redirect()->route('print-pdf-order-report-year');
    }
}
