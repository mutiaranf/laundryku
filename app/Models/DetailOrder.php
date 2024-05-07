<?php

namespace App\Models;

use App\Models\Order;
use App\Models\ServiceType;
use App\Models\PieceService;
use App\Models\ServicePackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailOrder extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function servicePackage()
    {
        return $this->belongsTo(ServicePackage::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function pieceService()
    {
        return $this->belongsTo(PieceService::class);
    }

}
