<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'reservation_id',
        'approver_id',
        'level',
        'status',
        'notes',
    ];
    
    // Define the relationship with the Reservation model
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    // Define the relationship with the User model
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
    // Define the relationship with the Log model
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
