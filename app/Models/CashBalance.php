<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBalance extends Model
{
    use HasFactory;

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
