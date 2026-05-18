<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // TAMBAHKAN INI
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // HAPUS CONSTRUCTOR DENGAN MIDDLEWARE
    
    // Tambahkan method untuk check admin access di setiap method
    private function checkAdmin()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!Auth::user()->is_admin) {
            abort(403, 'Akses ditolak. Hanya admin yang bisa mengakses halaman ini.');
        }
    }

    public function dashboard()
    {
        $this->checkAdmin();
        
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'active_rooms' => Room::where('is_active', true)->count(),
            'total_users' => User::where('is_admin', false)->count(),
        ];

        $recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }

    public function bookings(Request $request)
    {
        $this->checkAdmin();
        
        $query = Booking::with(['user', 'room']);

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('room_id') && $request->room_id) {
            $query->where('room_id', $request->room_id);
        }

        if ($request->has('date') && $request->date) {
            $query->where('booking_date', $request->date);
        }

        $bookings = $query->latest()->paginate(20);
        $rooms = Room::all();

        return view('admin.bookings.index', compact('bookings', 'rooms'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $this->checkAdmin();
        
        $request->validate([
            'status' => 'required|in:approved,rejected,completed,cancelled',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $booking->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'approved_at' => $request->status === 'approved' ? now() : null,
            'rejected_at' => $request->status === 'rejected' ? now() : null,
        ]);

        return back()->with('success', 'Status booking berhasil diupdate.');
    }

    public function rooms()
    {
        $this->checkAdmin();
        
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function createRoom()
    {
        $this->checkAdmin();
        
        return view('admin.rooms.create');
    }

    public function storeRoom(Request $request)
    {
        $this->checkAdmin();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');

        // Handle image upload - SIMPAN DI STORAGE
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate nama file yang unik
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            // Simpan di storage/app/public/rooms
            $imagePath = $image->storeAs('rooms', $imageName, 'public');
            
            $data['image'] = $imagePath; // Simpan path relatif
        }

        Room::create($data);

        return redirect()->route('admin.rooms')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function editRoom(Room $room)
    {
        $this->checkAdmin();
        
        return view('admin.rooms.edit', compact('room'));
    }

    public function updateRoom(Request $request, Room $room)
    {
        $this->checkAdmin();
        
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $room->id,
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image', 'remove_image');

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image == 1) {
            // Delete old image from storage if exists
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image from storage if exists
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            // Simpan di storage/app/public/rooms
            $imagePath = $image->storeAs('rooms', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $room->update($data);

        return redirect()->route('admin.rooms')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroyRoom(Room $room)
    {
        $this->checkAdmin();
        
        // Delete room image from storage if exists
        if ($room->image && Storage::disk('public')->exists($room->image)) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('admin.rooms')->with('success', 'Ruangan berhasil dihapus.');
    }

    public function exportBookings(Request $request)
    {
        $this->checkAdmin();
        
        $query = Booking::with(['user', 'room']);

        // Apply filters from request
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('room_id') && $request->room_id) {
            $query->where('room_id', $request->room_id);
        }

        if ($request->has('date') && $request->date) {
            $query->where('booking_date', $request->date);
        }

        $bookings = $query->get();
        
        $filename = "bookings-" . date('Y-m-d') . ".csv";
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        
        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header CSV
            fputcsv($file, [
                'Kode Booking',
                'Nama Pemesan', 
                'Email',
                'Telepon',
                'Ruangan',
                'Tanggal Booking', 
                'Waktu Mulai',
                'Waktu Selesai',
                'Durasi (Jam)',
                'Total Harga',
                'Tujuan',
                'Status',
                'Catatan Admin',
                'Tanggal Dibuat',
                'Tanggal Disetujui',
                'Tanggal Ditolak'
            ]);
            
            // Data rows
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->booking_code,
                    $booking->user->name,
                    $booking->user->email,
                    $booking->user->phone,
                    $booking->room->name,
                    $booking->booking_date->format('d-m-Y'),
                    $booking->start_time,
                    $booking->end_time,
                    $booking->total_hours,
                    'GRATIS',
                    $booking->purpose,
                    $this->getStatusText($booking->status),
                    $booking->admin_notes ?? '-',
                    $booking->created_at->format('d-m-Y H:i'),
                    $booking->approved_at ? $booking->approved_at->format('d-m-Y H:i') : '-',
                    $booking->rejected_at ? $booking->rejected_at->format('d-m-Y H:i') : '-'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function getStatusText($status)
    {
        $statuses = [
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
        
        return $statuses[$status] ?? $status;
    }
}