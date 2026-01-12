@extends('layouts.app')

@section('title', 'Kelola Ruangan - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Ruangan</h1>
                <p class="text-gray-600">Manajemen semua ruangan Sumedang Creative Center</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('home') }}" target="_blank" 
                   class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-medium shadow-sm hover:shadow transition-shadow duration-300">
                    <i class="fas fa-eye mr-2"></i> Lihat Website
                </a>
            </div>
        </div>
    </div>
    
    <!-- Room Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Ruangan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $rooms->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Ruangan Aktif</p>
                    <p class="text-2xl font-bold text-green-600">{{ $rooms->where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Ruangan Non-Aktif</p>
                    <p class="text-2xl font-bold text-gray-600">{{ $rooms->where('is_active', false)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times-circle text-gray-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <!-- Room Header -->
                <div class="relative">
                    <div class="h-48 bg-gradient-to-r from-red-100 to-red-200 flex items-center justify-center">
                        <i class="fas fa-building text-red-400 text-6xl"></i>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ 
                            $room->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                        }}">
                            {{ $room->is_active ? 'AKTIF' : 'NON-AKTIF' }}
                        </span>
                    </div>
                </div>
                
                <!-- Room Content -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $room->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $room->slug }}</p>
                        </div>
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium">
                            Rp {{ number_format($room->price_per_hour, 0, ',', '.') }}/jam
                        </span>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $room->description }}</p>
                    
                    <!-- Room Details -->
                    <div class="mb-4 space-y-2">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-users mr-2 text-red-500 text-sm"></i>
                            <span class="text-sm">Kapasitas: {{ $room->capacity }} orang</span>
                        </div>
                        <div class="flex items-start text-gray-700">
                            <i class="fas fa-wifi mr-2 text-red-500 text-sm mt-1"></i>
                            <span class="text-sm line-clamp-2">Fasilitas: {{ Str::limit($room->facilities, 60) }}</span>
                        </div>
                    </div>
                    
                    <!-- Booking Stats -->
                    @php
                        $todayBookings = $room->bookings()
                            ->whereDate('booking_date', \Carbon\Carbon::today())
                            ->whereIn('status', ['approved', 'pending'])
                            ->count();
                        $totalBookings = $room->bookings()->count();
                    @endphp
                    
                    <div class="mb-6 p-3 bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-2 gap-2 text-center">
                            <div>
                                <p class="text-xs text-gray-500">Booking Hari Ini</p>
                                <p class="font-bold text-gray-800">{{ $todayBookings }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Total Booking</p>
                                <p class="font-bold text-gray-800">{{ $totalBookings }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.rooms.edit', $room) }}" 
                           class="flex-1 bg-red-600 text-white text-center px-4 py-2.5 rounded-lg hover:bg-red-700 font-medium text-sm transition-colors duration-200 shadow-sm hover:shadow">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <a href="{{ route('room.detail', $room->slug) }}" target="_blank" 
                           class="flex-1 bg-gray-200 text-gray-800 text-center px-4 py-2.5 rounded-lg hover:bg-gray-300 font-medium text-sm transition-colors duration-200">
                            <i class="fas fa-eye mr-2"></i> Lihat
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Empty State -->
    @if($rooms->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-building text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada ruangan</h3>
            <p class="text-gray-500 mb-6">Tambahkan ruangan pertama Anda untuk mulai menerima booking.</p>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection