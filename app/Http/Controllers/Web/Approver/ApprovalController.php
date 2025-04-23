<?php

namespace App\Http\Controllers\Web\Approver;

use App\Http\Controllers\Controller;
use App\Models\BookingApproval;
use App\Models\VehicleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        $pendingApprovals = BookingApproval::with(['booking.vehicle', 'booking.driver', 'approver'])
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();

        return view('Approver.bookings.index', compact('pendingApprovals'));
    }

    public function approve(Request $request, $id)
    {
        $approval = BookingApproval::where('booking_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($approval->status !== 'pending') {
            return back()->withErrors('Pemesanan ini sudah diperoses.');
        }

        DB::beginTransaction();
        try {
            $approval->update([
                'status' => 'approved',
                'notes' => $request->notes ?? null,
            ]);

            // Cek apakah semua approval sudah disetujui
            $booking = $approval->booking;
            $allApproved = $booking->approvals()->where('status', 'approved')->count() === 2;

            if ($allApproved) {
                $booking->update(['status' => 'approved']);
            }

            DB::commit();
            return back()->with('success', 'Pemesanan Disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyetujui pemesanan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string|min:5',
        ]);

        $approval = BookingApproval::where('booking_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($approval->status !== 'pending') {
            return back()->withErrors('Pemesanan ini sudah diproses.');
        }

        DB::beginTransaction();
        try {
            // Update current approval to rejected
            $approval->update([
                'status' => 'rejected',
                'notes' => $request->notes
            ]);

            // Update other approvals to canceled or rejected (optional)
            BookingApproval::where('booking_id', $id)
                ->where('id', '!=', $approval->id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'rejected', // atau 'canceled' jika kamu pakai status ini
                    'notes' => 'Ditolak karena ditolak oleh approver level sebelumnya'
                ]);

            // Update booking status to rejected
            $approval->booking->update([
                'status' => 'rejected'
            ]);

            DB::commit();
            return back()->with('success', 'Pemesanan Ditolak.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menolak pemesanan: ' . $e->getMessage());
        }
    }
}
