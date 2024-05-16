<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\DetailOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detailOrder()
    {
       return $this->hasOne(DetailOrder::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }


    public function getTotalPriceAttribute() {
        $total = 0;
        foreach ($this->detailOrder as $detail) {
            $total += $detail->price * $detail->quantity;
        }
        return $total;
    }
}
