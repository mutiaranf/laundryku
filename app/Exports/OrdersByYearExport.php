<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class OrdersByYearExport implements FromQuery
{
   use Exportable;

   public function byYear($year)
   {
         $this->year = $year;

         return $this;

   }
    public function query()
    {
        return Order::query()
            ->whereRaw("YEAR(created_at) = $this->year");
    }
}
