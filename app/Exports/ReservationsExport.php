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
        $query = Reservation::query();

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_time', [$this->startDate, $this->endDate]);
        }

        return $query->get(['id', 'vehicle_id', 'user_id', 'approver_id', 'start_time', 'end_time','status', 'purpose', 'created_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Vehicle ID', 'Requested By', 'Approved By', 'Start Time', 'End Time', 'Status', 'Purpose', 'Created At'];
    }
}

