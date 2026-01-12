@extends('layouts.app')

@section('title', 'Booking Saya - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Booking Saya</h1>
            <p class="text-gray-600">Riwayat dan status booking ruangan Anda</p>
        </div>
        <a href="{{ route('home') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
            <i class="fas fa-plus mr-2"></i> Booking Baru
        </a>
    </div>
    
    @if($bookings->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <i class="fas fa-calendar-times text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada booking</h3>
            <p class="text-gray-600 mb-6">Anda belum membuat booking ruangan.</p>
            <a href="{{ route('home') }}" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                <i class="fas fa-search mr-2"></i> Cari Ruangan
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800">Riwayat Booking</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            <div class="p-6 hover:bg-gray-50">
                                <!-- Isi card booking tetap sama -->
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $booking->room->name }}</h3>
                                        <p class="text-gray-600">Kode: {{ $booking->booking_code }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ 
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
                                </div>
                                
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Tanggal</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Waktu</p>
                                        <p class="font-medium">{{ $booking->start_time }} - {{ $booking->end_time }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Durasi</p>
                                        <p class="font-medium">{{ $booking->total_hours }} jam</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total</p>
                                        <p class="font-medium">{{ $booking->formatted_total_price ?? 'Rp ' . number_format($booking->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-700">
                                        <i class="fas fa-bullseye mr-2"></i>
                                        {{ Str::limit($booking->purpose, 100) }}
                                    </p>
                                    
                                    <div class="flex space-x-2">
                                        <a href="{{ route('booking.show', $booking) }}" class="text-red-600 hover:text-red-700 font-medium">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                        @if($booking->status == 'pending')
                                            <form method="POST" action="{{ route('booking.cancel', $booking) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-gray-600 hover:text-gray-700 font-medium" onclick="return confirm('Batalkan booking ini?')">
                                                    <i class="fas fa-times mr-1"></i> Batal
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($booking->admin_notes)
                                    <div class="mt-4 p-3 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                                        <p class="text-sm text-yellow-700">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <span class="font-medium">Catatan Admin:</span> {{ $booking->admin_notes }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- PAGINATION - PASTIKAN INI ADA -->
                    @if($bookings->hasPages())
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium">{{ $bookings->firstItem() }}</span> 
                                    sampai <span class="font-medium">{{ $bookings->lastItem() }}</span> 
                                    dari <span class="font-medium">{{ $bookings->total() }}</span> booking
                                </div>
                                <div class="flex space-x-2">
                                    {{ $bookings->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Booking Stats -->
            <div>
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Booking</h3>
                    <div class="space-y-4">
                        @php
                            $stats = [
                                'total' => $bookings->total(),
                                'pending' => $bookings->where('status', 'pending')->count(),
                                'approved' => $bookings->where('status', 'approved')->count(),
                                'completed' => $bookings->where('status', 'completed')->count(),
                            ];
                        @endphp
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Booking</span>
                            <span class="font-bold text-gray-800">{{ $stats['total'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Menunggu</span>
                            <span class="font-bold text-yellow-600">{{ $stats['pending'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Disetujui</span>
                            <span class="font-bold text-green-600">{{ $stats['approved'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Selesai</span>
                            <span class="font-bold text-blue-600">{{ $stats['completed'] }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tips Booking</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <p class="text-sm text-gray-600">Booking minimal 2 hari sebelumnya untuk persiapan</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <p class="text-sm text-gray-600">Lengkapi data dengan benar untuk mempercepat proses</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <p class="text-sm text-gray-600">Periksa email secara berkala untuk konfirmasi admin</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <p class="text-sm text-gray-600">Hubungi admin jika booking belum dikonfirmasi dalam 24 jam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection