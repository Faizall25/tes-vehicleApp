<?php

namespace App\Http\Controllers\Web\Auth;

use App\Exports\BookingExport;
use App\Http\Controllers\Controller;
use App\Models\VehicleBooking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $monthlyBookings = VehicleBooking::selectRaw('MONTH(booking_date) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $vehicleUsage = VehicleBooking::with('vehicle')
            ->selectRaw('vehicle_id, COUNT(*) as total')
            ->groupBy('vehicle_id')
            ->with('vehicle')
            ->get()
            ->map(function ($booking) {
                return [
                    'name' => $booking->vehicle->name ?? 'Unknown',
                    'total' => $booking->total
                ];
            });

        return view('admin.dashboard', compact('monthlyBookings', 'vehicleUsage'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        return Excel::download(new BookingExport($request->start_date, $request->end_date), 'laporan_pemesanan.xlsx');
    }
}
