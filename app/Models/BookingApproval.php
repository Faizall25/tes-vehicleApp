<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingApproval extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'user_id', 'level', 'status', 'notes', 'approved_at'];

    public function approver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booking()
    {
        return $this->belongsTo(VehicleBooking::class, 'booking_id');
    }
}
