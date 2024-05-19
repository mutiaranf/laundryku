<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class OrdersByMonthExport implements FromQuery
{
    use Exportable;

    public function byBeetweenMonth($from, $to)
    {
        $this->from = $from;
        $this->to = $to;

        return $this;
    }
    public function query()
    {
        return Order::query()
        ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '>=', $this->from)
        ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), '<=', $this->to);

    }
}
