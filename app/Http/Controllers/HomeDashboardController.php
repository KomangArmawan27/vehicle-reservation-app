<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

class HomeDashboardController extends Controller
{
    // Display the user's reservations
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $reservations = Reservation::with('user', 'vehicle', 'driver')->get();
            return view('dashboard.home', compact('reservations'));
        }

        if ($user->role === 'approver') {
            $pendingApprovals = Approval::with('reservation.vehicle')
                ->where('approver_id', $user->id)
                ->where('status', 'pending')
                ->get();

            return view('dashboard.home', compact('pendingApprovals'));
        }

        $reservations = Reservation::with('vehicle', 'driver')
            ->where('user_id', $user->id)
            ->get();

        return view('dashboard.home', compact('reservations'));
    }

}
