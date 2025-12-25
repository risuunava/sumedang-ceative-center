@extends('layouts.app')

@section('title', 'Booking Saya - Sumedang Creative Center')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Top Navigation Bar -->
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-calendar-check text-red-600 text-xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">Booking Saya</h1>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Booking Baru
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div>
                    <p class="text-gray-600 mb-2">Selamat datang kembali,</p>
                    <h2 class="text-3xl font-light text-gray-900">Kelola Booking Anda</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Booking</p>
                        <p class="text-2xl font-medium text-gray-900">{{ $bookings->total() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-red-50 to-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-red-600"></i>
                    </div>
                </div>
            </div>

            <!-- Status Summary Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-800">Menunggu</p>
                            <p class="text-2xl font-bold text-blue-900 mt-1">{{ $bookings->where('status', 'pending')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-800">Disetujui</p>
                            <p class="text-2xl font-bold text-green-900 mt-1">{{ $bookings->where('status', 'approved')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-800">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $bookings->where('status', 'completed')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                            <i class="fas fa-check-double text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-800">Ditolak</p>
                            <p class="text-2xl font-bold text-red-900 mt-1">{{ $bookings->where('status', 'rejected')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                            <i class="fas fa-times text-red-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($bookings->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                <i class="fas fa-calendar-plus text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-light text-gray-900 mb-3">Belum Ada Booking</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">Mulai dengan membuat booking pertama Anda untuk ruangan di Sumedang Creative Center</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>
                Cari Ruangan
            </a>
        </div>
        @else
        <!-- Search, Filter, and Sort Section -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Booking</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search-input" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                               placeholder="Cari kode, ruangan, atau tujuan...">
                    </div>
                </div>

                <!-- Filter by Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                    <select id="status-filter" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="all">Semua Status</option>
                        <option value="pending">Menunggu</option>
                        <option value="approved">Disetujui</option>
                        <option value="completed">Selesai</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>

                <!-- Sort by -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select id="sort-by" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="date_asc">Tanggal (A-Z)</option>
                        <option value="date_desc">Tanggal (Z-A)</option>
                        <option value="status">Status</option>
                    </select>
                </div>
            </div>

            <!-- Additional Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <!-- Date Range Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rentang Tanggal</label>
                    <div class="flex space-x-2">
                        <input type="date" id="date-from" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <span class="flex items-center text-gray-500">s/d</span>
                        <input type="date" id="date-to" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Items Per Page -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tampilkan per halaman</label>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="per-page-btn px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ request('per_page', 10) == 10 ? 'bg-red-50 border-red-300 text-red-600' : '' }}" data-per-page="10">10</button>
                        <button type="button" class="per-page-btn px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ request('per_page', 10) == 25 ? 'bg-red-50 border-red-300 text-red-600' : '' }}" data-per-page="25">25</button>
                        <button type="button" class="per-page-btn px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ request('per_page', 10) == 50 ? 'bg-red-50 border-red-300 text-red-600' : '' }}" data-per-page="50">50</button>
                        <button type="button" class="per-page-btn px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 {{ request('per_page', 10) == 100 ? 'bg-red-50 border-red-300 text-red-600' : '' }}" data-per-page="100">100</button>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-medium">{{ $bookings->count() }}</span> dari <span class="font-medium">{{ $bookings->total() }}</span> booking
                </div>
                <div class="flex space-x-3">
                    <button type="button" id="clear-filters" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-times mr-2"></i>Reset Filter
                    </button>
                    <button type="button" id="apply-filters" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>Terapkan Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <!-- View Toggle Buttons -->
                <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                    <button type="button" id="list-view" class="view-toggle-btn px-4 py-2 bg-white border-r border-gray-300 hover:bg-gray-50" data-view="list">
                        <i class="fas fa-list"></i>
                    </button>
                    <button type="button" id="grid-view" class="view-toggle-btn px-4 py-2 bg-gray-50 hover:bg-gray-100" data-view="grid">
                        <i class="fas fa-th-large"></i>
                    </button>
                </div>
                
                <!-- Bulk Actions -->
                <div class="hidden" id="bulk-actions">
                    <select id="bulk-action-select" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">Pilih Aksi</option>
                        <option value="export">Export Selected</option>
                        <option value="print">Print Selected</option>
                    </select>
                </div>
            </div>
            
            <!-- Export Button -->
            <button type="button" id="export-btn" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Booking List/Grid -->
            <div class="lg:col-span-2">
                <div id="bookings-container" data-view="list">
                    <!-- List View -->
                    <div id="list-view-content" class="space-y-5">
                        @foreach($bookings as $booking)
                        <div class="booking-card group bg-white border border-gray-200 rounded-xl hover:border-gray-300 hover:shadow-md transition-all duration-300 overflow-hidden" 
                             data-status="{{ $booking->status }}" 
                             data-date="{{ $booking->booking_date }}"
                             data-code="{{ $booking->booking_code }}"
                             data-room="{{ $booking->room->name }}"
                             data-purpose="{{ $booking->purpose }}">
                            <!-- Card Header -->
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4">
                                            <div class="w-14 h-14 bg-gray-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-door-closed text-gray-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $booking->room->name }}</h3>
                                                <div class="flex items-center flex-wrap gap-3 mt-2">
                                                    <span class="inline-flex items-center text-sm text-gray-600">
                                                        <i class="fas fa-hashtag text-gray-400 mr-1.5"></i>
                                                        {{ $booking->booking_code }}
                                                    </span>
                                                    <span class="inline-flex items-center text-sm text-gray-600">
                                                        <i class="fas fa-users text-gray-400 mr-1.5"></i>
                                                        {{ $booking->room->capacity }} orang
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-3">
                                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold {{ 
                                            $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                            ($booking->status === 'approved' ? 'bg-green-100 text-green-800' :
                                            ($booking->status === 'rejected' ? 'bg-red-100 text-red-800' :
                                            ($booking->status === 'completed' ? 'bg-gray-100 text-gray-800' : 'bg-gray-100 text-gray-800')))
                                        }}">
                                            @if($booking->status == 'pending')
                                                <i class="fas fa-clock mr-1.5"></i>Menunggu
                                            @elseif($booking->status == 'approved')
                                                <i class="fas fa-check mr-1.5"></i>Disetujui
                                            @elseif($booking->status == 'rejected')
                                                <i class="fas fa-times mr-1.5"></i>Ditolak
                                            @elseif($booking->status == 'completed')
                                                <i class="fas fa-check-double mr-1.5"></i>Selesai
                                            @endif
                                        </span>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('booking.show', $booking) }}" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                                <i class="fas fa-eye mr-1.5"></i>Detail
                                            </a>
                                            @if($booking->status == 'pending')
                                            <span class="text-gray-300">•</span>
                                            <form method="POST" action="{{ route('booking.cancel', $booking) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-sm text-gray-600 hover:text-gray-700 font-medium" onclick="return confirm('Batalkan booking ini?')">
                                                    <i class="fas fa-times mr-1.5"></i>Batal
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Details -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                                    <div class="space-y-2">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="fas fa-calendar mr-2.5 text-gray-400"></i>
                                            <span>Tanggal</span>
                                        </div>
                                        <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="fas fa-clock mr-2.5 text-gray-400"></i>
                                            <span>Waktu</span>
                                        </div>
                                        <p class="font-medium text-gray-900">{{ $booking->start_time }} - {{ $booking->end_time }}</p>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="fas fa-hourglass-half mr-2.5 text-gray-400"></i>
                                            <span>Durasi</span>
                                        </div>
                                        <p class="font-medium text-gray-900">{{ $booking->total_hours }} jam</p>
                                    </div>
                                </div>

                                <!-- Purpose -->
                                <div class="mb-4">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <i class="fas fa-bullseye mr-2.5 text-gray-400"></i>
                                        <span>Tujuan</span>
                                    </div>
                                    <p class="text-gray-700">{{ Str::limit($booking->purpose, 120) }}</p>
                                </div>

                                <!-- Admin Notes -->
                                @if($booking->admin_notes)
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-start">
                                        <i class="fas fa-info-circle text-yellow-500 mt-0.5 mr-3"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 mb-1">Catatan Admin</p>
                                            <p class="text-sm text-gray-600">{{ $booking->admin_notes }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Grid View (Hidden by default) -->
                    <div id="grid-view-content" class="hidden grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach($bookings as $booking)
                        <div class="booking-card group bg-white border border-gray-200 rounded-xl hover:border-gray-300 hover:shadow-md transition-all duration-300 overflow-hidden"
                             data-status="{{ $booking->status }}" 
                             data-date="{{ $booking->booking_date }}"
                             data-code="{{ $booking->booking_code }}"
                             data-room="{{ $booking->room->name }}"
                             data-purpose="{{ $booking->purpose }}">
                            <div class="p-5">
                                <!-- Card Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900 truncate">{{ $booking->room->name }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $booking->booking_code }}</p>
                                    </div>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ 
                                        $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                        ($booking->status === 'approved' ? 'bg-green-100 text-green-800' :
                                        ($booking->status === 'rejected' ? 'bg-red-100 text-red-800' :
                                        ($booking->status === 'completed' ? 'bg-gray-100 text-gray-800' : 'bg-gray-100 text-gray-800')))
                                    }}">
                                        @if($booking->status == 'pending')
                                            Menunggu
                                        @elseif($booking->status == 'approved')
                                            Disetujui
                                        @elseif($booking->status == 'rejected')
                                            Ditolak
                                        @else
                                            Selesai
                                        @endif
                                    </span>
                                </div>

                                <!-- Booking Info -->
                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-calendar text-gray-400 mr-2 w-4"></i>
                                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-clock text-gray-400 mr-2 w-4"></i>
                                        <span class="text-gray-900">{{ $booking->start_time }} - {{ $booking->end_time }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-users text-gray-400 mr-2 w-4"></i>
                                        <span class="text-gray-900">{{ $booking->room->capacity }} orang</span>
                                    </div>
                                </div>

                                <!-- Purpose -->
                                <div class="mb-4">
                                    <p class="text-sm text-gray-700 line-clamp-2">{{ $booking->purpose }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <a href="{{ route('booking.show', $booking) }}" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                    @if($booking->status == 'pending')
                                    <form method="POST" action="{{ route('booking.cancel', $booking) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-700" onclick="return confirm('Batalkan booking ini?')">
                                            <i class="fas fa-times mr-1"></i>Batal
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- No Results Message -->
                <div id="no-results" class="hidden text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-search text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Tidak ada hasil</h3>
                    <p class="text-gray-600">Tidak ada booking yang sesuai dengan filter pencarian Anda.</p>
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                <div class="mt-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">{{ $bookings->firstItem() }}</span> - 
                            <span class="font-medium">{{ $bookings->lastItem() }}</span> dari 
                            <span class="font-medium">{{ $bookings->total() }}</span> booking
                        </div>
                        <div class="flex flex-wrap gap-2">
                            {{ $bookings->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Ringkasan</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Booking</span>
                            <span class="font-medium text-gray-900">{{ $bookings->total() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Menunggu Konfirmasi</span>
                            <span class="font-medium text-yellow-600">{{ $bookings->where('status', 'pending')->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Disetujui</span>
                            <span class="font-medium text-green-600">{{ $bookings->where('status', 'approved')->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Selesai</span>
                            <span class="font-medium text-gray-600">{{ $bookings->where('status', 'completed')->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Filters -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Cepat</h3>
                    <div class="space-y-3">
                        <button type="button" class="quick-filter-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors" data-status="pending">
                            <i class="fas fa-clock text-yellow-500 mr-2"></i>
                            <span>Menunggu ({{ $bookings->where('status', 'pending')->count() }})</span>
                        </button>
                        <button type="button" class="quick-filter-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors" data-status="approved">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Disetujui ({{ $bookings->where('status', 'approved')->count() }})</span>
                        </button>
                        <button type="button" class="quick-filter-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors" data-status="completed">
                            <i class="fas fa-check-double text-gray-500 mr-2"></i>
                            <span>Selesai ({{ $bookings->where('status', 'completed')->count() }})</span>
                        </button>
                    </div>
                </div>

                <!-- Upcoming Bookings -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Mendatang</h3>
                    <div class="space-y-4">
                        @php
                            $upcoming = $bookings->where('status', 'approved')
                                                ->where('booking_date', '>=', now()->toDateString())
                                                ->sortBy('booking_date')
                                                ->take(3);
                        @endphp
                        
                        @if($upcoming->count() > 0)
                            @foreach($upcoming as $upcomingBooking)
                            <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-door-open text-blue-600"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $upcomingBooking->room->name }}</p>
                                    <p class="text-xs text-gray-600">
                                        {{ \Carbon\Carbon::parse($upcomingBooking->booking_date)->format('d M') }} • {{ $upcomingBooking->start_time }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500 text-center py-2">Tidak ada booking mendatang</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Custom scrollbar */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* Card hover effects */
.booking-card:hover {
    transform: translateY(-2px);
}

/* View toggle active state */
.view-toggle-btn.active {
    background-color: #dc2626;
    color: white;
}

.view-toggle-btn.active:hover {
    background-color: #b91c1c;
}

/* Line clamp for text */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Pagination styles */
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin: 0 2px;
}

.pagination li a,
.pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 8px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    text-decoration: none;
    color: #4b5563;
    font-size: 14px;
    transition: all 0.2s;
}

.pagination li a:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
}

.pagination li.active span {
    background-color: #dc2626;
    border-color: #dc2626;
    color: white;
}

.pagination li.disabled span {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Quick filter active state */
.quick-filter-btn.active {
    background-color: #fef2f2;
    color: #dc2626;
    font-weight: 600;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Toggle
    const listViewBtn = document.getElementById('list-view');
    const gridViewBtn = document.getElementById('grid-view');
    const listViewContent = document.getElementById('list-view-content');
    const gridViewContent = document.getElementById('grid-view-content');
    const bookingsContainer = document.getElementById('bookings-container');

    listViewBtn.addEventListener('click', function() {
        this.classList.add('active', 'bg-red-600', 'text-white');
        gridViewBtn.classList.remove('active', 'bg-red-600', 'text-white');
        gridViewBtn.classList.add('bg-gray-50');
        this.classList.remove('bg-gray-50');
        
        listViewContent.classList.remove('hidden');
        gridViewContent.classList.add('hidden');
        bookingsContainer.setAttribute('data-view', 'list');
    });

    gridViewBtn.addEventListener('click', function() {
        this.classList.add('active', 'bg-red-600', 'text-white');
        listViewBtn.classList.remove('active', 'bg-red-600', 'text-white');
        listViewBtn.classList.add('bg-white');
        this.classList.remove('bg-gray-50');
        
        gridViewContent.classList.remove('hidden');
        listViewContent.classList.add('hidden');
        bookingsContainer.setAttribute('data-view', 'grid');
    });

    // Search functionality
    const searchInput = document.getElementById('search-input');
    const bookingCards = document.querySelectorAll('.booking-card');
    const noResults = document.getElementById('no-results');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCards = 0;

        bookingCards.forEach(card => {
            const code = card.getAttribute('data-code').toLowerCase();
            const room = card.getAttribute('data-room').toLowerCase();
            const purpose = card.getAttribute('data-purpose').toLowerCase();
            
            if (code.includes(searchTerm) || room.includes(searchTerm) || purpose.includes(searchTerm)) {
                card.style.display = '';
                visibleCards++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCards === 0 && searchTerm !== '') {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    });

    // Status filter
    const statusFilter = document.getElementById('status-filter');
    const quickFilterBtns = document.querySelectorAll('.quick-filter-btn');

    function filterByStatus(status) {
        let visibleCards = 0;

        bookingCards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            
            if (status === 'all' || cardStatus === status) {
                card.style.display = '';
                visibleCards++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCards === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }

        // Update active state of quick filter buttons
        quickFilterBtns.forEach(btn => {
            if (btn.getAttribute('data-status') === status) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    statusFilter.addEventListener('change', function() {
        filterByStatus(this.value);
    });

    quickFilterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            statusFilter.value = status;
            filterByStatus(status);
        });
    });

    // Sort functionality
    const sortBySelect = document.getElementById('sort-by');
    
    sortBySelect.addEventListener('change', function() {
        const sortValue = this.value;
        const cardsArray = Array.from(bookingCards);
        
        cardsArray.sort((a, b) => {
            const dateA = new Date(a.getAttribute('data-date'));
            const dateB = new Date(b.getAttribute('data-date'));
            
            switch(sortValue) {
                case 'newest':
                    return dateB - dateA; // Newest first
                case 'oldest':
                    return dateA - dateB; // Oldest first
                case 'date_asc':
                    return dateA - dateB; // Date ascending
                case 'date_desc':
                    return dateB - dateA; // Date descending
                case 'status':
                    const statusA = a.getAttribute('data-status');
                    const statusB = b.getAttribute('data-status');
                    return statusA.localeCompare(statusB);
                default:
                    return 0;
            }
        });
        
        // Reorder cards in DOM
        const container = bookingCards[0].parentNode;
        cardsArray.forEach(card => {
            container.appendChild(card);
        });
    });

    // Date range filter
    const dateFrom = document.getElementById('date-from');
    const dateTo = document.getElementById('date-to');

    function filterByDate() {
        const from = dateFrom.value ? new Date(dateFrom.value) : null;
        const to = dateTo.value ? new Date(dateTo.value) : null;
        
        bookingCards.forEach(card => {
            const cardDate = new Date(card.getAttribute('data-date'));
            
            let shouldShow = true;
            if (from && cardDate < from) shouldShow = false;
            if (to && cardDate > to) shouldShow = false;
            
            card.style.display = shouldShow ? '' : 'none';
        });
    }

    dateFrom.addEventListener('change', filterByDate);
    dateTo.addEventListener('change', filterByDate);

    // Items per page
    const perPageBtns = document.querySelectorAll('.per-page-btn');
    
    perPageBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const perPage = this.getAttribute('data-per-page');
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', perPage);
            window.location.href = url.toString();
        });
    });

    // Clear filters
    document.getElementById('clear-filters').addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = 'all';
        sortBySelect.value = 'newest';
        dateFrom.value = '';
        dateTo.value = '';
        
        // Reset all cards
        bookingCards.forEach(card => {
            card.style.display = '';
        });
        
        noResults.classList.add('hidden');
        
        // Reset quick filter buttons
        quickFilterBtns.forEach(btn => {
            btn.classList.remove('active');
        });
    });

    // Apply filters (reload page with filters)
    document.getElementById('apply-filters').addEventListener('click', function() {
        const params = new URLSearchParams();
        
        if (searchInput.value) params.set('search', searchInput.value);
        if (statusFilter.value !== 'all') params.set('status', statusFilter.value);
        if (sortBySelect.value !== 'newest') params.set('sort', sortBySelect.value);
        if (dateFrom.value) params.set('from', dateFrom.value);
        if (dateTo.value) params.set('to', dateTo.value);
        
        const url = new URL(window.location.href);
        url.search = params.toString();
        window.location.href = url.toString();
    });

    // Export functionality
    document.getElementById('export-btn').addEventListener('click', function() {
        // Show loading
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengekspor...';
        this.disabled = true;
        
        setTimeout(() => {
            // In real implementation, this would make an API call
            const exportData = {
                search: searchInput.value,
                status: statusFilter.value,
                sort: sortBySelect.value,
                dateFrom: dateFrom.value,
                dateTo: dateTo.value
            };
            
            console.log('Exporting with filters:', exportData);
            alert('Data berhasil diekspor!');
            
            // Reset button
            this.innerHTML = originalText;
            this.disabled = false;
        }, 1000);
    });

    // Initialize from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('search')) {
        searchInput.value = urlParams.get('search');
        searchInput.dispatchEvent(new Event('input'));
    }
    
    if (urlParams.has('status')) {
        statusFilter.value = urlParams.get('status');
        filterByStatus(statusFilter.value);
    }
    
    if (urlParams.has('sort')) {
        sortBySelect.value = urlParams.get('sort');
        sortBySelect.dispatchEvent(new Event('change'));
    }
    
    if (urlParams.has('from')) {
        dateFrom.value = urlParams.get('from');
    }
    
    if (urlParams.has('to')) {
        dateTo.value = urlParams.get('to');
    }
    
    if (dateFrom.value || dateTo.value) {
        filterByDate();
    }

    // Add smooth scrolling to top when filtering
    const filterElements = [searchInput, statusFilter, sortBySelect, dateFrom, dateTo];
    filterElements.forEach(element => {
        element.addEventListener('change', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
});
</script>
@endsection