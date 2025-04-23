<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingApproval;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleBookingController extends Controller
{
    public function index(Request $request)
    {
        $query  = VehicleBooking::with(['vehicle', 'driver']);

        if ($request->filled('search')) {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->get();

        return view('Admin.bookings.index', compact('bookings'));
    }
    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers1 = User::where('role', 'approver_1')->get();
        $approvers2 = User::where('role', 'approver_2')->get();

        return view('Admin.bookings.create', compact('vehicles', 'drivers', 'approvers1', 'approvers2'));
    }

    public function store(Request $request)
    {
        Log::info('Data request store booking:', $request->all());

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'approver_1_id' => 'required|exists:users,id',
            'approver_2_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $booking = VehicleBooking::create([
                'user_id' => auth()->id(),
                'vehicle_id' => $validated['vehicle_id'],
                'driver_id' => $validated['driver_id'],
                'approver_1_id' => $validated['approver_1_id'],
                'approver_2_id' => $validated['approver_2_id'],
                'booking_date' => $validated['booking_date'],
                'start_date' => Carbon::parse($validated['start_date']),
                'end_date' => Carbon::parse($validated['end_date']),
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Buat 2 approval level
            BookingApproval::create([
                'booking_id' => $booking->id,
                'user_id' => $request->approver_1_id,
                'level' => 1,
                'status' => 'pending',
            ]);

            BookingApproval::create([
                'booking_id' => $booking->id,
                'user_id' => $request->approver_2_id,
                'level' => 2,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('admin.bookings.index')->with('success', 'Pemesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal simpan booking:', ['error' => $e->getMessage()]);
            return back()->withErrors(['msg' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $booking = VehicleBooking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->withErrors('Pemesanan Tidak Bisa di Edit karena sudah di proses.');
        }

        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers1 = User::where('role', 'approver_1')->get();
        $approvers2 = User::where('role', 'approver_2')->get();

        return view('Admin.bookings.edit', compact('booking', 'vehicles', 'drivers', 'approvers1', 'approvers2'));
    }

    public function update(Request $request, $id)
    {
        $booking = VehicleBooking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->withErrors('Pemesanan tidak bisa diubah karena sudah diproses.');
        }

        $validated  = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'approver_1_id' => 'required|exists:users,id',
            'approver_2_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
        ]);

        $booking->update([
            'vehicle_id' => $validated['vehicle_id'],
            'driver_id' => $validated['driver_id'],
            'approver_1_id' => $validated['approver_1_id'],
            'approver_2_id' => $validated['approver_2_id'],
            'booking_date' => $validated['booking_date'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Pemesanan success diperbarui.');
    }

    public function cancel($id)
    {
        $booking = VehicleBooking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->withErrors('Pemesanan tidak bisa dibatalkan karena sudah diproses.');
        }

        $booking->update([
            'status' => 'canceled',
            'notes' => 'Dibatalkan oleh admin pada' . now(),
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}
