<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = Approval::with('reservation', 'reservation.user', 'reservation.vehicle')
            ->where('approver_id', Auth::id())
            ->whereNull('status') // pending only
            ->get();

        return view('approvals.index', compact('approvals'));
    }

    public function update(Request $request, Approval $approval)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Only allow if previous level is approved
        if ($approval->level === 2) {
            $prevApproval = Approval::where('reservation_id', $approval->reservation_id)
                ->where('level', 1)
                ->first();
            if ($prevApproval->status !== 'approved') {
                return back()->with('error', 'Level 1 approval required first.');
            }
        }

        $approval->update([
            'status' => $request->status,
        ]);

        // If both levels approved, update reservation status
        if ($request->status === 'approved') {
            $allApproved = Approval::where('reservation_id', $approval->reservation_id)
                ->where('status', '!=', 'approved')
                ->doesntExist();

            if ($allApproved) {
                $approval->reservation->update(['status' => 'approved']);
            }
        } elseif ($request->status === 'rejected') {
            $approval->reservation->update(['status' => 'rejected']);
        }

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'action' => "Reservation ID {$approval->reservation_id} {$request->status} by level {$approval->level}"
        ]);

        return back()->with('success', 'Approval updated.');
    }
}
