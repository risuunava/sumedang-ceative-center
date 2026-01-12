@extends('layouts.app')

@section('title', 'Dashboard Admin - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-gray-600">Manajemen booking ruangan Sumedang Creative Center</p>
    </div>
    
    @php
        use App\Models\Booking;
        use App\Models\Room;
        use App\Models\User;
    @endphp
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-alt text-red-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Booking</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Booking::count() }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-500">Update terbaru</p>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Booking::where('status', 'pending')->count() }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.bookings') }}?status=pending" class="text-xs text-yellow-600 hover:text-yellow-700 font-medium">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-building text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Ruangan Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Room::where('is_active', true)->count() }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.rooms') }}" class="text-xs text-green-600 hover:text-green-700 font-medium">
                    Kelola ruangan <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ User::where('is_admin', false)->count() }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-500">Pengguna terdaftar</p>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Bookings -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Booking Terbaru</h2>
                    <a href="{{ route('admin.bookings') }}" class="text-red-600 hover:text-red-700 font-medium text-sm">
                        Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemesan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $recentBookings = Booking::with(['user', 'room'])
                                    ->latest()
                                    ->limit(10)
                                    ->get();
                            @endphp
                            
                            @foreach($recentBookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->booking_code }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->created_at->format('d/m H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->room->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->booking_date->format('d M') }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->start_time }} - {{ $booking->end_time }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ 
                                            $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                            ($booking->status === 'approved' ? 'bg-green-100 text-green-800' :
                                            ($booking->status === 'rejected' ? 'bg-red-100 text-red-800' :
                                            ($booking->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')))
                                        }}">
                                            @if($booking->status == 'pending')
                                                <i class="fas fa-clock mr-1"></i>
                                            @elseif($booking->status == 'approved')
                                                <i class="fas fa-check mr-1"></i>
                                            @elseif($booking->status == 'rejected')
                                                <i class="fas fa-times mr-1"></i>
                                            @elseif($booking->status == 'completed')
                                                <i class="fas fa-check-double mr-1"></i>
                                            @else
                                                <i class="fas fa-ban mr-1"></i>
                                            @endif
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($recentBookings->isEmpty())
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-times text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Belum ada booking</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div>
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.bookings') }}?status=pending" 
                       class="flex items-center p-3 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Konfirmasi Booking</p>
                            <p class="text-sm text-gray-600">{{ Booking::where('status', 'pending')->count() }} pending</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                    
                    <a href="{{ route('admin.rooms') }}" 
                       class="flex items-center p-3 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-building text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Kelola Ruangan</p>
                            <p class="text-sm text-gray-600">{{ Room::where('is_active', true)->count() }} aktif</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                    
                    <a href="{{ route('admin.bookings') }}" 
                       class="flex items-center p-3 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-list text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Semua Booking</p>
                            <p class="text-sm text-gray-600">{{ Booking::count() }} total</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                    
                    <button onclick="exportCSV()" 
                       class="w-full flex items-center p-3 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-file-csv text-purple-600"></i>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="font-medium text-gray-800">Export Data</p>
                            <p class="text-sm text-gray-600">Download CSV</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                </div>
            </div>
            
            <!-- Stats Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Hari Ini</h3>
                <div class="space-y-4">
                    @php
                        $today = \Carbon\Carbon::today();
                        $todayBookings = Booking::whereDate('created_at', $today)->count();
                        $todayApproved = Booking::whereDate('created_at', $today)->where('status', 'approved')->count();
                    @endphp
                    
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-red-500 mr-2"></i>
                            <span class="text-gray-700">Booking Hari Ini</span>
                        </div>
                        <span class="font-bold text-gray-800">{{ $todayBookings }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Disetujui Hari Ini</span>
                        </div>
                        <span class="font-bold text-green-600">{{ $todayApproved }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-percentage text-blue-500 mr-2"></i>
                            <span class="text-gray-700">Rate Approval</span>
                        </div>
                        <span class="font-bold text-blue-600">
                            {{ $todayBookings > 0 ? round(($todayApproved / $todayBookings) * 100, 1) : 0 }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Room Status -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Status Ruangan Hari Ini</h2>
            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
                $rooms = Room::where('is_active', true)->limit(5)->get();
                $today = \Carbon\Carbon::today()->format('Y-m-d');
            @endphp
            
            @foreach($rooms as $room)
                @php
                    $bookedToday = $room->bookings()
                        ->where('booking_date', $today)
                        ->whereIn('status', ['approved', 'pending'])
                        ->count();
                    $status = $bookedToday > 0 ? 'terpakai' : 'tersedia';
                @endphp
                
                <div class="border border-gray-200 rounded-lg p-4 hover:border-red-300 transition-colors duration-200">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-gray-800 text-sm">{{ $room->name }}</h4>
                        <span class="text-xs px-2 py-1 rounded-full {{ 
                            $status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                        }}">
                            {{ $status }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-600 mb-3">Kapasitas: {{ $room->capacity }} orang</p>
                    <div class="text-xs text-gray-500">
                        @if($bookedToday > 0)
                            <i class="fas fa-calendar-check mr-1"></i> {{ $bookedToday }} booking
                        @else
                            <i class="fas fa-calendar-plus mr-1"></i> Tersedia
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6 text-center">
            <a href="{{ route('admin.rooms') }}" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium">
                Lihat semua ruangan <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
function exportCSV() {
    window.location.href = "{{ route('admin.export.bookings') }}";
}
</script>
@endsection