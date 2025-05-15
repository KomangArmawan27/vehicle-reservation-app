<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ReservationsExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Reservation::with('vehicle'); // eager load vehicle

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        $reservations = $query->get([
            'id',
            'vehicle_id',
            'driver_id',
            'user_id',
            'start_time',
            'end_time',
            'status',
            'purpose',
            'created_at'
        ]);

        // Map the collection to replace vehicle_id with vehicle->name
        return $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'vehicle_name' => $reservation->vehicle ? $reservation->vehicle->name : '-',
                'driver_id' => $reservation->driver ? $reservation->driver->name : '-',
                'user_id' => $reservation->user ? $reservation->user->name : '-',
                'start_time' => $reservation->start_time,
                'end_time' => $reservation->end_time,
                'status' => $reservation->status,
                'purpose' => $reservation->purpose,
                'created_at' => $reservation->created_at,
            ];
        });
    }


    public function headings(): array
    {
        return ['ID', 'Vehicle ID', 'Driver ID', 'Requested By', 'Start Time', 'End Time', 'Status', 'Purpose', 'Created At'];
    }
}

