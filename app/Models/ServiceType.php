<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'estimated_time',
        'description',
        'icon',
        'unit',
    ];


    public function servicePackages(){
        return $this->hasMany(ServicePackage::class);
    }
}
