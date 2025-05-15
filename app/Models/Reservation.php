<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'driver_id',
        'approver_id',
        'start_time',
        'end_time',
        'status',
        'purpose',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    
    // Define the relationship with the Driver model
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Define the relationship with the Approval model
    public function approval()
    {
        return $this->hasOne(Approval::class);
    }

    // Define the relationship with the Log model
    public function logs()
    {
        return $this->hasMany(Log::class);
    }   
}
