<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::where('is_active', true)->get();
        $today = now()->format('Y-m-d');
        
        return view('home', compact('rooms', 'today'));
    }

    public function sop()
    {
        $sops = Sop::where('is_active', true)->orderBy('order')->get();
        return view('sop', compact('sops'));
    }

    public function roomDetail($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        $today = now()->format('Y-m-d');
        
        // PERBAIKAN: Tambahkan variable $rooms untuk similar rooms
        $rooms = Room::where('is_active', true)
                    ->where('id', '!=', $room->id)
                    ->limit(3)
                    ->get();
        
        return view('room-detail', compact('room', 'today', 'rooms'));
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $room = Room::findOrFail($request->room_id);
        $bookings = $room->availableSlots($request->date);
        
        $bookedSlots = [];
        foreach ($bookings as $booking) {
            $bookedSlots[] = [
                'start' => $booking->start_time,
                'end' => $booking->end_time,
            ];
        }

        return response()->json([
            'booked_slots' => $bookedSlots,
            'room' => $room
        ]);
    }
}