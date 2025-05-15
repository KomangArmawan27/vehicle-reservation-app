<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Reservation;
use App\Models\Approval;
use App\Models\Log;

class ReservationController extends Controller
{
    // Create a new reservation
    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers = User::where('role', 'approver')->get(); // adjust role name as needed

        return view('reservations.create', compact('vehicles', 'drivers', 'approvers'));
    }

    // Store the reservation
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'approver_level_1' => 'required|exists:users,id',
            'approver_level_2' => 'required|exists:users,id',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
            'purpose' => $request->purpose,
        ]);

        // Level 1 approval
        Approval::create([
            'reservation_id' => $reservation->id,
            'approver_id' => $request->approver_level_1,
            'level' => 1,
        ]);

        // Level 2 approval
        Approval::create([
            'reservation_id' => $reservation->id,
            'approver_id' => $request->approver_level_2,
            'level' => 2,
        ]);

        // Log it
        Log::create([
            'user_id' => Auth::id(),
            'action' => "Created reservation ID {$reservation->id}"
        ]);

        return redirect()->route('reservations.create')->with('success', 'Reservation submitted!');
    }
}
