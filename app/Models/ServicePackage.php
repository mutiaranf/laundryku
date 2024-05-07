<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'photo',
        'service_types_id',
        'estimated_time',
    ];


    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
