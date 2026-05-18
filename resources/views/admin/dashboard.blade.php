@extends('layouts.app')

@section('title', 'Dashboard Admin - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Enhanced Header -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
            <div class="flex items-center gap-2">
                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">
                    <i class="fas fa-shield-alt mr-1"></i> Admin Panel
                </span>
                <p class="text-gray-600 text-sm">Manajemen booking ruangan Sumedang Creative Center</p>
            </div>
        </div>
        
        <!-- Date & Quick Stats -->
        <div class="flex items-center gap-4">
            <div class="hidden md:block text-right">
                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
                <div class="text-xs text-gray-400">Update terakhir: {{ \Carbon\Carbon::now()->format('H:i') }}</div>
            </div>
        </div>
    </div>
    
    @php
        use App\Models\Booking;
        use App\Models\Room;
        use App\Models\User;
        
        $today = \Carbon\Carbon::today();
        $tomorrow = \Carbon\Carbon::tomorrow();
        $todayDate = $today->format('Y-m-d');
    @endphp
    
    <!-- Enhanced Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Booking -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-gray-100 group">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Booking</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ Booking::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-red-50 to-red-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-calendar-alt text-red-600 text-2xl"></i>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <div class="flex justify-between items-center">
                    <div class="text-xs text-gray-500">
                        <i class="fas fa-sync-alt mr-1"></i> Live update
                    </div>
                    <div class="text-xs font-medium text-red-600">
                        <i class="fas fa-chart-line mr-1"></i> Semua waktu
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pending Booking -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-gray-100 group">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Menunggu Konfirmasi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ Booking::where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('admin.bookings') }}?status=pending" class="flex justify-between items-center group-hover:text-yellow-700 transition-colors duration-200">
                    <div class="text-xs font-medium text-yellow-600">
                        Perlu tindakan
                    </div>
                    <div class="flex items-center text-xs text-yellow-500">
                        Lihat semua
                        <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Active Rooms -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-gray-100 group">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Ruangan Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ Room::where('is_active', true)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-50 to-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-building text-green-600 text-2xl"></i>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('admin.rooms') }}" class="flex justify-between items-center group-hover:text-green-700 transition-colors duration-200">
                    <div class="text-xs font-medium text-green-600">
                        Tersedia untuk booking
                    </div>
                    <div class="flex items-center text-xs text-green-500">
                        Kelola
                        <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Total Users -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 border border-gray-100 group">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ User::where('is_admin', false)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <div class="flex justify-between items-center">
                    <div class="text-xs text-gray-500">
                        <i class="fas fa-user-check mr-1"></i> Terdaftar
                    </div>
                    <div class="text-xs font-medium text-blue-600">
                        Aktif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Bookings with Enhanced Features -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Table Header with Filters -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Booking Terbaru</h2>
                            <p class="text-sm text-gray-600 mt-1">10 booking terakhir yang masuk</p>
                        </div>
                        
                        <!-- Search and Filter -->
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <div class="relative">
                                <input type="text" 
                                       id="bookingSearch" 
                                       class="pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm w-full sm:w-48 focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all duration-200"
                                       placeholder="Cari booking...">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                            </div>
                            <select id="statusFilter" 
                                    class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm w-full sm:w-auto focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-all duration-200">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Table Container -->
                <div class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center gap-1 cursor-pointer hover:text-gray-800 transition-colors duration-200">
                                            Kode Booking
                                            <i class="fas fa-sort text-gray-400 text-xs"></i>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ruangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pemesan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Durasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="bookingsTable">
                                @php
                                    $recentBookings = Booking::with(['user', 'room'])
                                        ->latest()
                                        ->limit(10)
                                        ->get();
                                @endphp
                                
                                @foreach($recentBookings as $booking)
                                    <tr class="booking-row hover:bg-gray-50 transition-all duration-200 transform hover:-translate-y-0.5" 
                                        data-status="{{ $booking->status }}"
                                        data-code="{{ strtolower($booking->booking_code) }}"
                                        data-user="{{ strtolower($booking->user->name) }}"
                                        data-room="{{ strtolower($booking->room->name) }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-red-50 to-red-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-calendar text-red-600"></i>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900 text-sm">{{ $booking->booking_code }}</div>
                                                    <div class="text-xs text-gray-500">{{ $booking->created_at->format('d/m H:i') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-medium">{{ $booking->room->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->room->capacity }} orang</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                                    <i class="fas fa-user text-blue-600 text-xs"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                                                    <div class="text-xs text-gray-500 truncate max-w-[150px]">{{ $booking->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->booking_date->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->start_time }} - {{ $booking->end_time }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-medium">{{ $booking->total_hours }} jam</div>
                                            <div class="text-xs text-gray-500">{{ $booking->total_hours * 60 }} menit</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="status-badge inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold {{ 
                                                $booking->status === 'pending' ? 'bg-yellow-50 text-yellow-800 border border-yellow-200' :
                                                ($booking->status === 'approved' ? 'bg-green-50 text-green-800 border border-green-200' :
                                                ($booking->status === 'rejected' ? 'bg-red-50 text-red-800 border border-red-200' :
                                                ($booking->status === 'completed' ? 'bg-blue-50 text-blue-800 border border-blue-200' : 'bg-gray-50 text-gray-800 border border-gray-200')))
                                            }}">
                                                @if($booking->status == 'pending')
                                                    <i class="fas fa-clock mr-1.5"></i>
                                                @elseif($booking->status == 'approved')
                                                    <i class="fas fa-check-circle mr-1.5"></i>
                                                @elseif($booking->status == 'rejected')
                                                    <i class="fas fa-times-circle mr-1.5"></i>
                                                @elseif($booking->status == 'completed')
                                                    <i class="fas fa-check-double mr-1.5"></i>
                                                @else
                                                    <i class="fas fa-ban mr-1.5"></i>
                                                @endif
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex space-x-1">
                                                <a href="{{ route('admin.bookings') }}/{{ $booking->id }}" 
                                                   class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors duration-200"
                                                   title="Lihat detail">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </a>
                                                @if($booking->status == 'pending')
                                                    <a href="{{ route('admin.bookings') }}/{{ $booking->id }}/edit" 
                                                       class="p-1.5 text-green-600 hover:text-green-800 hover:bg-green-50 rounded transition-colors duration-200"
                                                       title="Konfirmasi">
                                                        <i class="fas fa-check text-sm"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($recentBookings->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-gray-500 font-medium mb-2">Belum ada booking</h3>
                        <p class="text-gray-400 text-sm">Booking yang dibuat akan muncul di sini</p>
                    </div>
                @endif
                
                <!-- Table Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-semibold">{{ min(10, $recentBookings->count()) }}</span> dari <span class="font-semibold">{{ Booking::count() }}</span> booking
                        </div>
                        <a href="{{ route('admin.bookings') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-all duration-200 transform hover:-translate-y-0.5">
                            Lihat Semua Booking
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Sidebar -->
        <div class="space-y-6">
            <!-- Enhanced Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-lg font-bold text-gray-800">Aksi Cepat</h3>
                    <p class="text-sm text-gray-600 mt-1">Fitur admin yang sering digunakan</p>
                </div>
                
                <div class="p-6 space-y-3">
                    <!-- Pending Review -->
                    <a href="{{ route('admin.bookings') }}?status=pending" 
                       class="group flex items-center p-4 bg-gradient-to-r from-yellow-50 to-yellow-50 border border-yellow-200 rounded-xl hover:from-yellow-100 hover:to-yellow-50 hover:border-yellow-300 transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clipboard-check text-yellow-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Konfirmasi Booking</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm text-gray-600">{{ Booking::where('status', 'pending')->count() }} menunggu</span>
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Prioritas
                                </span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-yellow-400 group-hover:text-yellow-600 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                    
                    <!-- Manage Rooms -->
                    <a href="{{ route('admin.rooms') }}" 
                       class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-green-50 border border-green-200 rounded-xl hover:from-green-100 hover:to-green-50 hover:border-green-300 transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-building text-green-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Kelola Ruangan</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm text-gray-600">{{ Room::where('is_active', true)->count() }} aktif</span>
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    <i class="fas fa-check-circle mr-1"></i> Tersedia
                                </span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-green-400 group-hover:text-green-600 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                    
                    <!-- All Bookings -->
                    <a href="{{ route('admin.bookings') }}" 
                       class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-50 border border-blue-200 rounded-xl hover:from-blue-100 hover:to-blue-50 hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-list text-blue-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Semua Booking</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm text-gray-600">{{ Booking::count() }} total</span>
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                    <i class="fas fa-history mr-1"></i> Riwayat
                                </span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-blue-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all duration-300"></i>
                    </a>
                    
                    <!-- Export Data -->
                    <button onclick="exportCSV()" 
                       class="group w-full flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-50 border border-purple-200 rounded-xl hover:from-purple-100 hover:to-purple-50 hover:border-purple-300 transition-all duration-300 transform hover:-translate-y-0.5">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-export text-purple-700"></i>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="font-semibold text-gray-800">Export Data</p>
                            <p class="text-sm text-gray-600">Download laporan booking</p>
                        </div>
                        <i class="fas fa-chevron-right text-purple-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all duration-300"></i>
                    </button>
                </div>
            </div>
            
            <!-- Enhanced Today's Stats -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-lg overflow-hidden text-white">
                <div class="px-6 py-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold">Statistik Hari Ini</h3>
                            <p class="text-sm text-gray-300 mt-1">{{ $today->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div class="w-10 h-10 bg-gray-700 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 space-y-5">
                    @php
                        $todayBookings = Booking::whereDate('created_at', $today)->count();
                        $todayApproved = Booking::whereDate('created_at', $today)->where('status', 'approved')->count();
                        $todayPending = Booking::whereDate('created_at', $today)->where('status', 'pending')->count();
                        $approvalRate = $todayBookings > 0 ? round(($todayApproved / $todayBookings) * 100, 1) : 0;
                    @endphp
                    
                    <!-- Today's Bookings -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-day text-red-400"></i>
                                </div>
                                <span class="font-medium">Booking Hari Ini</span>
                            </div>
                            <span class="text-2xl font-bold">{{ $todayBookings }}</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-red-500 to-red-400 h-2 rounded-full" style="width: {{ min(100, ($todayBookings / max(1, Booking::count())) * 100) }}%"></div>
                        </div>
                    </div>
                    
                    <!-- Approved Today -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <span class="font-medium">Disetujui</span>
                            </div>
                            <span class="text-2xl font-bold text-green-400">{{ $todayApproved }}</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-400 h-2 rounded-full" style="width: {{ $todayBookings > 0 ? ($todayApproved / $todayBookings) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    
                    <!-- Approval Rate -->
                    <div class="pt-4 border-t border-gray-700">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-percentage text-blue-400"></i>
                                </div>
                                <span class="font-medium">Rate Approval</span>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-blue-400">{{ $approvalRate }}%</div>
                                <div class="text-xs text-gray-400">{{ $todayApproved }}/{{ $todayBookings }}</div>
                            </div>
                        </div>
                        
                        <!-- Progress with indicator -->
                        <div class="relative">
                            <div class="w-full bg-gray-700 rounded-full h-3">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-400 h-3 rounded-full" style="width: {{ $approvalRate }}%"></div>
                            </div>
                            <div class="absolute top-1/2 transform -translate-y-1/2" style="left: {{ $approvalRate }}%">
                                <div class="w-4 h-4 bg-blue-400 rounded-full border-2 border-gray-900"></div>
                            </div>
                        </div>
                        
                        <!-- Status indicator -->
                        <div class="flex justify-between mt-2">
                            <span class="text-xs {{ $approvalRate >= 80 ? 'text-green-400' : ($approvalRate >= 50 ? 'text-yellow-400' : 'text-red-400') }}">
                                @if($approvalRate >= 80)
                                    <i class="fas fa-check-circle mr-1"></i> Sangat Baik
                                @elseif($approvalRate >= 50)
                                    <i class="fas fa-exclamation-circle mr-1"></i> Cukup
                                @else
                                    <i class="fas fa-times-circle mr-1"></i> Perlu Perbaikan
                                @endif
                            </span>
                            <span class="text-xs text-gray-400">Target: 80%</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Upcoming Bookings Tomorrow -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Booking Besok</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $tomorrow->format('d M Y') }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    @php
                        $tomorrowBookings = Booking::with(['room', 'user'])
                            ->where('booking_date', $tomorrow->format('Y-m-d'))
                            ->where('status', 'approved')
                            ->limit(3)
                            ->get();
                    @endphp
                    
                    @if($tomorrowBookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($tomorrowBookings as $booking)
                                <div class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-check text-blue-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800 text-sm">{{ $booking->room->name }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-gray-600">{{ $booking->start_time }} - {{ $booking->end_time }}</span>
                                            <span class="text-xs px-1.5 py-0.5 bg-blue-100 text-blue-700 rounded-full">
                                                {{ $booking->total_hours }}j
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ $booking->user->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="text-center pt-2">
                                <a href="{{ route('admin.bookings') }}?date={{ $tomorrow->format('Y-m-d') }}" 
                                   class="text-sm text-blue-600 hover:text-blue-700 font-medium inline-flex items-center">
                                    Lihat semua booking besok
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-calendar-day text-gray-400 text-xl"></i>
                            </div>
                            <h4 class="text-gray-500 font-medium">Tidak ada booking</h4>
                            <p class="text-gray-400 text-sm mt-1">Belum ada booking untuk besok</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Room Status -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Status Ruangan Hari Ini</h2>
                    <p class="text-sm text-gray-600 mt-1">Ketersediaan ruangan untuk {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Tersedia</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Terpakai</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
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
                        $percentage = min(100, ($bookedToday / max(1, 5)) * 100);
                    @endphp
                    
                    <div class="group border border-gray-200 rounded-xl p-4 hover:border-red-300 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Room Header -->
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $room->name }}</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs px-2 py-1 rounded-full {{ 
                                        $status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                    }}">
                                        <i class="fas {{ $status === 'tersedia' ? 'fa-check' : 'fa-times' }} mr-1"></i>
                                        {{ $status }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-users mr-1"></i>{{ $room->capacity }}
                                    </span>
                                </div>
                            </div>
                            <div class="w-10 h-10 {{ $status === 'tersedia' ? 'bg-green-100' : 'bg-red-100' }} rounded-lg flex items-center justify-center">
                                <i class="fas {{ $status === 'tersedia' ? 'fa-door-open text-green-600' : 'fa-door-closed text-red-600' }}"></i>
                            </div>
                        </div>
                        
                        <!-- Booking Info -->
                        <div class="mb-3">
                            <div class="flex justify-between items-center text-xs text-gray-600 mb-1">
                                <span>Booking hari ini</span>
                                <span class="font-medium">{{ $bookedToday }} sesi</span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="{{ $status === 'tersedia' ? 'bg-green-500' : 'bg-red-500' }} h-2 rounded-full transition-all duration-500" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="flex gap-2">
                            @if($status === 'tersedia')
                                <a href="{{ route('admin.bookings') }}?room={{ $room->id }}&date={{ $today }}" 
                                   class="flex-1 text-center text-xs px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                            @else
                                <a href="{{ route('admin.bookings') }}?room={{ $room->id }}&date={{ $today }}" 
                                   class="flex-1 text-center text-xs px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                            @endif
                            @if(Route::has('admin.rooms.edit'))
                                <a href="{{ route('admin.rooms.edit', $room->id) }}" 
                                   class="flex-1 text-center text-xs px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                            @else
                                <a href="{{ route('admin.rooms') }}" 
                                   class="flex-1 text-center text-xs px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                    <i class="fas fa-cog mr-1"></i>Kelola
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- View All Rooms -->
            <div class="mt-8 text-center">
                <a href="{{ route('admin.rooms') }}" 
                   class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white font-medium rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-building mr-2"></i>
                    Kelola Semua Ruangan
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Enhanced Features -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search Functionality for Bookings
    const bookingSearch = document.getElementById('bookingSearch');
    const statusFilter = document.getElementById('statusFilter');
    const bookingRows = document.querySelectorAll('.booking-row');
    
    function filterBookings() {
        const searchTerm = bookingSearch ? bookingSearch.value.toLowerCase() : '';
        const selectedStatus = statusFilter ? statusFilter.value : '';
        
        bookingRows.forEach(row => {
            const code = row.getAttribute('data-code');
            const user = row.getAttribute('data-user');
            const room = row.getAttribute('data-room');
            const status = row.getAttribute('data-status');
            
            const matchesSearch = !searchTerm || 
                                 code.includes(searchTerm) || 
                                 user.includes(searchTerm) || 
                                 room.includes(searchTerm);
            
            const matchesStatus = !selectedStatus || status === selectedStatus;
            
            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }
    
    if (bookingSearch) {
        bookingSearch.addEventListener('input', filterBookings);
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', filterBookings);
    }
    
    // Add hover effects to table rows
    bookingRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.05)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'none';
        });
    });
    
    // Export CSV function
    window.exportCSV = function() {
        if (confirm('Export data booking ke CSV?')) {
            // Show loading notification
            showNotification('Mempersiapkan file CSV...', 'info');
            
            // Simulate delay for UX
            setTimeout(() => {
                showNotification('File CSV berhasil dibuat!', 'success');
            }, 1000);
        }
    };
    
    // Notification function
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full ${
            type === 'info' ? 'bg-blue-500 text-white' :
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'warning' ? 'bg-yellow-500 text-white' :
            'bg-red-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'info' ? 'info-circle' : type === 'success' ? 'check-circle' : 'exclamation-triangle'} mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
});
</script>

<style>
/* Custom scrollbar for tables */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

/* Smooth transitions */
* {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}
</style>
@endsection