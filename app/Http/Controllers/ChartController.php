<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // Get reservations count grouped by date (formatted as Y-m-d string)
        $usageStats = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item) {
                // Make sure date is a string (Y-m-d)
                $item->date = (string) $item->date;
                return $item;
            });

        return view('dashboard.chart', compact('usageStats'));
    }
}
