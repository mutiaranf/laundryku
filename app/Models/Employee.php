<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'outlet_id', 'position_id', 'gender', 'email', 'phone', 'photo', 'status', 'address', 'salary', 'account_number', 'dob'];


    public static function boot(): void
    {
        parent::boot();
        static::created(function ($employee) {
            $position = Position::find($employee->position_id);
            if ($position->name == 'Store Manager') {
                $user = new User();
                $user->name = $employee->name;
                $user->email = $employee->email;
                $user->employee_id = $employee->id;
                $user->profile_photo_path = $employee->photo;
                $user->email_verified_at = now();
                $user->phone = $employee->phone;
                $user->status = $employee->status;
                $user->password = bcrypt('password');
                $user->save();
                $user->assignRole('supervisor');
            }
        });
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
