<?php

namespace App\Exports;

use App\Models\VehicleBooking;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    protected $startDate, $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection(): Collection
    {
        return VehicleBooking::with(['vehicle', 'driver'])
            ->whereBetween('booking_date', [$this->startDate, $this->endDate])
            ->get()
            ->map(function ($booking) {
                return [
                    'Tanggal Booking' => date('Y-m-d', strtotime($booking->booking_date)),
                    'Kendaraan'       => optional($booking->vehicle)->name ?? '-',
                    'Driver'          => optional($booking->driver)->name ?? '-',
                    'Status'          => ucfirst($booking->status),
                    'Catatan'         => $booking->notes ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['Tanggal Booking', 'Kendaraan', 'Driver', 'Status', 'Catatan'];
    }
}
