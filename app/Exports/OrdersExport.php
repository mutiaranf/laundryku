<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class OrdersExport implements FromQuery
{
   use Exportable;

    public function byBetweenDate($from, $to)
    {
        $this->from = $from;
        $this->to = $to;

        return $this;
    }



    public function query()
    {
        return Order::query()
        ->whereDate('created_at', '>=', $this->from)
        ->whereDate('created_at', '<=', $this->to);
    }
}
