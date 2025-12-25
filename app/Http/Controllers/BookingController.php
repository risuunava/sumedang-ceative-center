<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()->with('room')->latest()->paginate(10);
        return view('booking.index', compact('bookings'));
    }

    public function create($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        return view('booking.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'purpose' => 'required|string|max:500',
        ]);

        // Validasi manual: end_time harus setelah start_time
        if (strtotime($request->end_time) <= strtotime($request->start_time)) {
            return back()->withErrors(['end_time' => 'Waktu selesai harus setelah waktu mulai.']);
        }

        // Hitung durasi
        $start = strtotime($request->start_time);
        $end = strtotime($request->end_time);
        $totalHours = ($end - $start) / 3600;

        // Validasi durasi minimal 2 jam
        if ($totalHours < 1.99) {
            return back()->withErrors([
                'end_time' => 'Durasi minimal booking adalah 2 jam. Anda memilih ' . 
                             number_format($totalHours, 2) . ' jam. Contoh: 08:00 - 10:00'
            ]);
        }

        $room = Room::findOrFail($request->room_id);

        // Cek ketersediaan ruangan
        $conflictingBooking = Booking::where('room_id', $request->room_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->first();

        if ($conflictingBooking) {
            return back()->withErrors([
                'start_time' => 'Ruangan sudah dibooking pada jam tersebut (' . 
                               $conflictingBooking->start_time . ' - ' . $conflictingBooking->end_time . ').'
            ]);
        }

        // Buat booking - GRATIS
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'booking_code' => 'BK' . Str::random(8),
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_hours' => round($totalHours, 2),
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.index')->with('success', 
            '✅ Booking berhasil dibuat! Kode Booking: ' . $booking->booking_code . '. Menunggu persetujuan admin.'
        );
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('booking.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'Booking berhasil dibatalkan.');
        }

        return back()->withErrors(['error' => 'Booking tidak dapat dibatalkan.']);
    }
}