@extends('layouts.app')

@section('title', 'Detail Booking - Sumedang Creative Center')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Header -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-4 md:py-6">
            <!-- Mobile Layout -->
            <div class="block md:hidden">
                <!-- Top Row: Back Button and Status -->
                <div class="flex items-center justify-between mb-4">
                    <a href="{{ Auth::user()->is_admin ? route('admin.bookings') : route('booking.index') }}" 
                       class="group flex items-center space-x-2 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-gray-200 flex items-center justify-center transition-all duration-200 group-hover:shadow-sm">
                            <i class="fas fa-arrow-left text-sm"></i>
                        </div>
                    </a>
                    
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold shadow-sm {{ 
                        $booking->status === 'pending' ? 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200 hover:bg-yellow-100' :
                        ($booking->status === 'approved' ? 'bg-green-50 text-green-700 ring-1 ring-green-200 hover:bg-green-100' :
                        ($booking->status === 'rejected' ? 'bg-red-50 text-red-700 ring-1 ring-red-200 hover:bg-red-100' :
                        ($booking->status === 'completed' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-200 hover:bg-blue-100' : 
                        'bg-gray-50 text-gray-700 ring-1 ring-gray-200 hover:bg-gray-100')))
                    }} transition-colors duration-200">
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
                </div>
                
                <!-- Title and Booking Code -->
                <div class="mb-4">
                    <h1 class="text-xl font-bold text-gray-900 mb-1">Detail Booking</h1>
                    <div class="flex items-center space-x-2">
                        <span class="text-xs font-medium bg-gray-100 text-gray-700 px-2 py-1 rounded">#{{ $booking->booking_code }}</span>
                        <span class="text-xs text-gray-500">{{ $booking->created_at->format('d M, H:i') }}</span>
                    </div>
                </div>
                
                <!-- Action Button for Mobile -->
                @if(Auth::user()->is_admin)
                    <div class="mb-4">
                        <button onclick="showModal()"
                                class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200 shadow-sm hover:shadow active:scale-[0.98]">
                            <i class="fas fa-edit"></i>
                            <span class="font-medium">Ubah Status</span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Desktop Layout -->
            <div class="hidden md:flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ Auth::user()->is_admin ? route('admin.bookings') : route('booking.index') }}" 
                       class="group flex items-center space-x-2 text-gray-600 hover:text-gray-900 transition-all duration-200">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-gray-200 flex items-center justify-center transition-all duration-200 group-hover:shadow-sm">
                            <i class="fas fa-arrow-left text-sm"></i>
                        </div>
                        <span class="font-medium group-hover:text-gray-900 transition-colors duration-200">Kembali</span>
                    </a>
                    
                    <div class="hidden md:block h-6 w-px bg-gray-200"></div>
                    
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">Detail Booking</h1>
                        <div class="flex items-center space-x-3 mt-1">
                            <span class="text-sm text-gray-500 hover:text-gray-700 transition-colors duration-200 cursor-default">#{{ $booking->booking_code }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-sm text-gray-500 hover:text-gray-700 transition-colors duration-200 cursor-default">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold shadow-sm {{ 
                        $booking->status === 'pending' ? 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200 hover:bg-yellow-100 hover:shadow' :
                        ($booking->status === 'approved' ? 'bg-green-50 text-green-700 ring-1 ring-green-200 hover:bg-green-100 hover:shadow' :
                        ($booking->status === 'rejected' ? 'bg-red-50 text-red-700 ring-1 ring-red-200 hover:bg-red-100 hover:shadow' :
                        ($booking->status === 'completed' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-200 hover:bg-blue-100 hover:shadow' : 
                        'bg-gray-50 text-gray-700 ring-1 ring-gray-200 hover:bg-gray-100 hover:shadow')))
                    }} transition-all duration-200 cursor-default">
                        @if($booking->status == 'pending')
                            <i class="fas fa-clock mr-2"></i>
                        @elseif($booking->status == 'approved')
                            <i class="fas fa-check-circle mr-2"></i>
                        @elseif($booking->status == 'rejected')
                            <i class="fas fa-times-circle mr-2"></i>
                        @elseif($booking->status == 'completed')
                            <i class="fas fa-check-double mr-2"></i>
                        @else
                            <i class="fas fa-ban mr-2"></i>
                        @endif
                        {{ ucfirst($booking->status) }}
                    </span>
                    
                    @if(Auth::user()->is_admin)
                        <button onclick="showModal()"
                                class="flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200 shadow-sm hover:shadow active:scale-[0.98]">
                            <i class="fas fa-edit"></i>
                            <span>Ubah Status</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-6 md:py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 mb-6 md:mb-8">
            <div class="bg-white rounded-xl border border-gray-100 p-4 md:p-5 shadow-sm hover:shadow hover:border-gray-200 transition-all duration-200 cursor-default group">
                <div class="flex items-center">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 group-hover:from-blue-100 group-hover:to-blue-200 flex items-center justify-center mr-3 md:mr-4 transition-all duration-200">
                        <i class="fas fa-clock text-blue-600 group-hover:text-blue-700 transition-colors duration-200"></i>
                    </div>
                    <div>
                        <div class="text-xs md:text-sm text-gray-500 font-medium">Durasi</div>
                        <div class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">{{ $booking->total_hours }} jam</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-100 p-4 md:p-5 shadow-sm hover:shadow hover:border-gray-200 transition-all duration-200 cursor-default group">
                <div class="flex items-center">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-gradient-to-br from-green-50 to-green-100 group-hover:from-green-100 group-hover:to-green-200 flex items-center justify-center mr-3 md:mr-4 transition-all duration-200">
                        <i class="fas fa-calendar-alt text-green-600 group-hover:text-green-700 transition-colors duration-200"></i>
                    </div>
                    <div>
                        <div class="text-xs md:text-sm text-gray-500 font-medium">Tanggal</div>
                        <div class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">{{ $booking->booking_date->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-100 p-4 md:p-5 shadow-sm hover:shadow hover:border-gray-200 transition-all duration-200 cursor-default group">
                <div class="flex items-center">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 group-hover:from-purple-100 group-hover:to-purple-200 flex items-center justify-center mr-3 md:mr-4 transition-all duration-200">
                        <i class="fas fa-users text-purple-600 group-hover:text-purple-700 transition-colors duration-200"></i>
                    </div>
                    <div>
                        <div class="text-xs md:text-sm text-gray-500 font-medium">Kapasitas</div>
                        <div class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">{{ $booking->room->capacity }} orang</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 md:gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-5 md:space-y-6">
                <!-- Room Information Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 transition-all duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 flex items-center justify-center transition-all duration-200">
                                    <i class="fas fa-building text-gray-600 hover:text-gray-700 transition-colors duration-200"></i>
                                </div>
                                <div>
                                    <h2 class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">Informasi Ruangan</h2>
                                    <p class="text-xs md:text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">{{ $booking->room->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div class="flex flex-col md:flex-row md:items-start space-y-5 md:space-y-0 md:space-x-6">
                            <div class="w-full md:w-28 h-40 md:h-28 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                                <i class="fas fa-building text-gray-400 hover:text-gray-500 text-3xl md:text-4xl transition-colors duration-200"></i>
                            </div>
                            
                            <div class="flex-1">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-4">
                                    <div>
                                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 hover:text-gray-600 transition-colors duration-200">Kapasitas</div>
                                        <div class="flex items-center text-gray-900 hover:text-gray-800 transition-colors duration-200">
                                            <i class="fas fa-users mr-3 text-gray-400 hover:text-gray-500 transition-colors duration-200"></i>
                                            <span class="font-semibold">{{ $booking->room->capacity }} orang</span>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 hover:text-gray-600 transition-colors duration-200">Tipe</div>
                                        <div class="flex items-center text-gray-900 hover:text-gray-800 transition-colors duration-200">
                                            <i class="fas fa-door-open mr-3 text-gray-400 hover:text-gray-500 transition-colors duration-200"></i>
                                            <span class="font-semibold">Ruangan {{ $booking->room->type ?? 'Meeting' }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="sm:col-span-2">
                                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 hover:text-gray-600 transition-colors duration-200">Fasilitas</div>
                                        <div class="flex flex-wrap gap-2">
                                            @php
                                                $facilities = explode(',', $booking->room->facilities);
                                            @endphp
                                            @foreach($facilities as $facility)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs md:text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-800 transition-all duration-200 cursor-default">
                                                    <i class="fas fa-check-circle mr-2 text-green-500 hover:text-green-600 text-xs transition-colors duration-200"></i>
                                                    {{ trim($facility) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="sm:col-span-2 pt-4 mt-4 border-t border-gray-100">
                                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 hover:text-gray-600 transition-colors duration-200">Deskripsi</div>
                                        <p class="text-gray-600 hover:text-gray-700 leading-relaxed transition-colors duration-200">{{ $booking->room->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Details Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 flex items-center justify-center transition-all duration-200">
                                <i class="fas fa-calendar-check text-blue-600 hover:text-blue-700 transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h2 class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">Jadwal Booking</h2>
                                <p class="text-xs md:text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">Detail waktu penggunaan</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                            <!-- Time Details -->
                            <div class="space-y-5">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                                        <i class="fas fa-calendar-alt text-blue-500 hover:text-blue-600 transition-colors duration-200"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs md:text-sm font-medium text-gray-500 mb-1 hover:text-gray-600 transition-colors duration-200">Tanggal Booking</div>
                                        <div class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">{{ $booking->booking_date->format('l, d F Y') }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                                        <i class="fas fa-clock text-blue-500 hover:text-blue-600 transition-colors duration-200"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs md:text-sm font-medium text-gray-500 mb-1 hover:text-gray-600 transition-colors duration-200">Waktu Penggunaan</div>
                                        <div class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">{{ $booking->start_time }} - {{ $booking->end_time }}</div>
                                        <div class="text-xs md:text-sm text-gray-500 hover:text-gray-600 mt-1 transition-colors duration-200">{{ $booking->total_hours }} jam ({{ $booking->total_hours * 60 }} menit)</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Booking Status -->
                            <div class="space-y-5">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-green-50 hover:bg-green-100 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                                        <i class="fas fa-check-circle text-green-500 hover:text-green-600 transition-colors duration-200"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs md:text-sm font-medium text-gray-500 mb-1 hover:text-gray-600 transition-colors duration-200">Status Booking</div>
                                        <div class="text-base md:text-lg font-semibold text-green-600 hover:text-green-700 transition-colors duration-200">{{ ucfirst($booking->status) }}</div>
                                        <div class="text-xs md:text-sm text-gray-500 hover:text-gray-600 mt-1 transition-colors duration-200">
                                            @if($booking->status === 'approved')
                                                Ruangan disetujui untuk digunakan
                                            @elseif($booking->status === 'pending')
                                                Menunggu konfirmasi admin
                                            @elseif($booking->status === 'rejected')
                                                Booking tidak disetujui
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-100 hover:border-gray-200 transition-colors duration-200">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 hover:text-gray-600 transition-colors duration-200">Catatan</div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 rounded-full bg-green-500 hover:bg-green-600 transition-colors duration-200"></div>
                                        <span class="text-sm font-medium text-gray-900 hover:text-gray-800 transition-colors duration-200">Gratis</span>
                                        <span class="text-xs text-gray-500 hover:text-gray-600 transition-colors duration-200">(Tidak ada biaya sewa)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purpose Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-100 to-orange-200 hover:from-orange-200 hover:to-orange-300 flex items-center justify-center transition-all duration-200">
                                <i class="fas fa-bullseye text-orange-600 hover:text-orange-700 transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h2 class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">Tujuan Penggunaan</h2>
                                <p class="text-xs md:text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">Deskripsi kegiatan</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div class="bg-gradient-to-br from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 rounded-lg p-4 md:p-5 border border-gray-100 hover:border-gray-200 transition-all duration-200">
                            <div class="flex">
                                <i class="fas fa-quote-left text-gray-300 hover:text-gray-400 text-lg md:text-xl mr-3 md:mr-4 mt-1 transition-colors duration-200"></i>
                                <p class="text-gray-700 hover:text-gray-800 leading-relaxed transition-colors duration-200">{{ $booking->purpose }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-5 md:space-y-6">
                <!-- User Information Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 flex items-center justify-center transition-all duration-200">
                                <i class="fas fa-user text-blue-600 hover:text-blue-700 transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h2 class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">Informasi Pemesan</h2>
                                <p class="text-xs md:text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">Data kontak pemesan</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 flex items-center justify-center transition-all duration-200">
                                <i class="fas fa-user text-blue-500 hover:text-blue-600 text-xl md:text-2xl transition-colors duration-200"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 text-base md:text-lg hover:text-gray-800 transition-colors duration-200">{{ $booking->user->name }}</div>
                                <div class="text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">{{ $booking->user->email }}</div>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 hover:bg-blue-200 text-blue-800 hover:text-blue-900 transition-all duration-200">
                                        <i class="fas fa-user-check mr-1 text-xs"></i>
                                        Pengguna Terdaftar
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center group">
                                <div class="w-10 h-10 rounded-lg bg-gray-50 group-hover:bg-gray-100 flex items-center justify-center mr-3 transition-all duration-200">
                                    <i class="fas fa-phone text-gray-500 group-hover:text-gray-600 transition-colors duration-200"></i>
                                </div>
                                <div>
                                    <div class="text-xs md:text-sm text-gray-500 group-hover:text-gray-600 transition-colors duration-200">Telepon</div>
                                    <a href="tel:{{ $booking->user->phone }}" class="font-medium text-gray-900 hover:text-blue-600 transition-colors duration-200">
                                        {{ $booking->user->phone }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex items-center group">
                                <div class="w-10 h-10 rounded-lg bg-gray-50 group-hover:bg-gray-100 flex items-center justify-center mr-3 transition-all duration-200">
                                    <i class="fas fa-map-marker-alt text-gray-500 group-hover:text-gray-600 transition-colors duration-200"></i>
                                </div>
                                <div>
                                    <div class="text-xs md:text-sm text-gray-500 group-hover:text-gray-600 transition-colors duration-200">Alamat</div>
                                    <div class="font-medium text-gray-900 hover:text-gray-800 transition-colors duration-200">{{ $booking->user->address }}</div>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100 hover:border-gray-200 transition-colors duration-200">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="group">
                                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1 group-hover:text-gray-600 transition-colors duration-200">Bergabung</div>
                                        <div class="text-sm text-gray-900 group-hover:text-gray-800 transition-colors duration-200">{{ $booking->user->created_at->format('M Y') }}</div>
                                    </div>
                                    <div class="group">
                                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1 group-hover:text-gray-600 transition-colors duration-200">Total Booking</div>
                                        <div class="text-sm text-gray-900 group-hover:text-gray-800 transition-colors duration-200">{{ $booking->user->bookings->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-100 to-purple-200 hover:from-purple-200 hover:to-purple-300 flex items-center justify-center transition-all duration-200">
                                <i class="fas fa-history text-purple-600 hover:text-purple-700 transition-colors duration-200"></i>
                            </div>
                            <div>
                                <h2 class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">Timeline</h2>
                                <p class="text-xs md:text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">Riwayat status</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div class="space-y-6 relative">
                            <!-- Vertical Line -->
                            <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200 hover:bg-gray-300 transition-colors duration-200"></div>
                            
                            <!-- Created -->
                            <div class="relative flex items-start group">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-green-100 group-hover:bg-green-200 flex items-center justify-center z-10 transition-all duration-200">
                                    <i class="fas fa-plus text-green-600 group-hover:text-green-700 transition-colors duration-200"></i>
                                </div>
                                <div class="ml-3 md:ml-4 flex-1">
                                    <div class="font-semibold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">Booking Dibuat</div>
                                    <div class="text-sm text-gray-500 group-hover:text-gray-600 mt-1 transition-colors duration-200">{{ $booking->created_at->format('d M Y, H:i') }}</div>
                                    <div class="text-xs text-gray-400 group-hover:text-gray-500 mt-1 transition-colors duration-200">Reservasi berhasil dibuat</div>
                                </div>
                            </div>

                            <!-- Approved -->
                            @if($booking->approved_at)
                                <div class="relative flex items-start group">
                                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-green-100 group-hover:bg-green-200 flex items-center justify-center z-10 transition-all duration-200">
                                        <i class="fas fa-check text-green-600 group-hover:text-green-700 transition-colors duration-200"></i>
                                    </div>
                                    <div class="ml-3 md:ml-4 flex-1">
                                        <div class="font-semibold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">Disetujui</div>
                                        <div class="text-sm text-gray-500 group-hover:text-gray-600 mt-1 transition-colors duration-200">{{ $booking->approved_at->format('d M Y, H:i') }}</div>
                                        <div class="text-xs text-gray-400 group-hover:text-gray-500 mt-1 transition-colors duration-200">Booking telah disetujui</div>
                                    </div>
                                </div>
                            @endif

                            <!-- Rejected -->
                            @if($booking->rejected_at)
                                <div class="relative flex items-start group">
                                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-red-100 group-hover:bg-red-200 flex items-center justify-center z-10 transition-all duration-200">
                                        <i class="fas fa-times text-red-600 group-hover:text-red-700 transition-colors duration-200"></i>
                                    </div>
                                    <div class="ml-3 md:ml-4 flex-1">
                                        <div class="font-semibold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">Ditolak</div>
                                        <div class="text-sm text-gray-500 group-hover:text-gray-600 mt-1 transition-colors duration-200">{{ $booking->rejected_at->format('d M Y, H:i') }}</div>
                                        <div class="text-xs text-gray-400 group-hover:text-gray-500 mt-1 transition-colors duration-200">Booking tidak disetujui</div>
                                    </div>
                                </div>
                            @endif

                            <!-- Current Status -->
                            <div class="relative flex items-start group">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-full {{ 
                                    $booking->status === 'pending' ? 'bg-yellow-100 group-hover:bg-yellow-200' :
                                    ($booking->status === 'approved' ? 'bg-green-100 group-hover:bg-green-200' :
                                    ($booking->status === 'rejected' ? 'bg-red-100 group-hover:bg-red-200' :
                                    ($booking->status === 'completed' ? 'bg-blue-100 group-hover:bg-blue-200' : 'bg-gray-100 group-hover:bg-gray-200')))
                                }} flex items-center justify-center z-10 transition-all duration-200">
                                    <i class="fas {{ 
                                        $booking->status === 'pending' ? 'fa-clock text-yellow-600 group-hover:text-yellow-700' :
                                        ($booking->status === 'approved' ? 'fa-check-circle text-green-600 group-hover:text-green-700' :
                                        ($booking->status === 'rejected' ? 'fa-times-circle text-red-600 group-hover:text-red-700' :
                                        ($booking->status === 'completed' ? 'fa-check-double text-blue-600 group-hover:text-blue-700' : 'fa-ban text-gray-600 group-hover:text-gray-700')))
                                    }} transition-colors duration-200"></i>
                                </div>
                                <div class="ml-3 md:ml-4 flex-1">
                                    <div class="font-semibold text-gray-900 group-hover:text-gray-800 transition-colors duration-200">Status Saat Ini</div>
                                    <div class="text-sm text-gray-500 group-hover:text-gray-600 mt-1 transition-colors duration-200">
                                        @if($booking->status === 'pending')
                                            Menunggu konfirmasi admin
                                        @elseif($booking->status === 'approved')
                                            Siap digunakan sesuai jadwal
                                        @elseif($booking->status === 'rejected')
                                            Booking tidak dapat diproses
                                        @elseif($booking->status === 'completed')
                                            Booking telah selesai
                                        @else
                                            Booking dibatalkan
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Notes -->
                @if($booking->admin_notes)
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl border border-yellow-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="px-5 md:px-6 py-4 md:py-5 border-b border-yellow-200 hover:border-yellow-300 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition-all duration-200">
                                    <i class="fas fa-info-circle text-yellow-600 hover:text-yellow-700 transition-colors duration-200"></i>
                                </div>
                                <div>
                                    <h2 class="text-base md:text-lg font-semibold text-yellow-900 hover:text-yellow-800 transition-colors duration-200">Pesan Admin</h2>
                                    <p class="text-xs md:text-sm text-yellow-700 hover:text-yellow-800 transition-colors duration-200">Catatan penting untuk Anda</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-5 md:p-6">
                            <div class="bg-white/80 hover:bg-white/90 rounded-lg p-4 border border-yellow-200 hover:border-yellow-300 transition-all duration-200">
                                <div class="flex items-start">
                                    <i class="fas fa-comment-alt text-yellow-500 hover:text-yellow-600 mr-3 mt-1 transition-colors duration-200"></i>
                                    <div class="flex-1">
                                        <p class="text-yellow-800 hover:text-yellow-900 leading-relaxed transition-colors duration-200">{{ $booking->admin_notes }}</p>
                                        @if($booking->approved_at || $booking->rejected_at)
                                            <div class="text-xs text-yellow-600 hover:text-yellow-700 mt-3 transition-colors duration-200">
                                                <i class="fas fa-clock mr-1"></i>
                                                Dikirim {{ ($booking->approved_at ?? $booking->rejected_at)->format('d M Y, H:i') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Admin Actions -->
                @if(Auth::user()->is_admin)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white hover:from-gray-100 hover:to-gray-50 transition-all duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-100 to-red-200 hover:from-red-200 hover:to-red-300 flex items-center justify-center transition-all duration-200">
                                    <i class="fas fa-cog text-red-600 hover:text-red-700 transition-colors duration-200"></i>
                                </div>
                                <div>
                                    <h2 class="text-base md:text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200">Aksi Admin</h2>
                                    <p class="text-xs md:text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">Kelola booking ini</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-5 md:p-6">
                            <div class="space-y-3">
                                <button onclick="showModal()"
                                        class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200 shadow-sm hover:shadow active:scale-[0.98]">
                                    <i class="fas fa-edit"></i>
                                    <span class="font-medium">Ubah Status</span>
                                </button>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <a href="{{ route('admin.bookings') }}" 
                                       class="flex items-center justify-center space-x-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-800 rounded-lg transition-all duration-200">
                                        <i class="fas fa-arrow-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                    
                                    @if($booking->status == 'pending')
                                        <a href="{{ route('admin.bookings') }}/{{ $booking->id }}/edit" 
                                           class="flex items-center justify-center space-x-2 px-4 py-3 bg-blue-100 hover:bg-blue-200 text-blue-700 hover:text-blue-800 rounded-lg transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Premium Modal -->
<div id="statusModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 sm:px-6 pt-6 pb-4">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-100 to-red-200 hover:from-red-200 hover:to-red-300 flex items-center justify-center transition-all duration-200">
                            <i class="fas fa-edit text-red-600 hover:text-red-700 transition-colors duration-200"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 hover:text-gray-800 transition-colors duration-200" id="modal-title">Ubah Status Booking</h3>
                            <p class="text-sm text-gray-500 hover:text-gray-600 transition-colors duration-200">#{{ $booking->booking_code }}</p>
                        </div>
                    </div>
                    <button onclick="hideModal()" class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <form id="statusForm" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" id="modal_booking_id" name="booking_id" value="{{ $booking->id }}">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3 hover:text-gray-800 transition-colors duration-200">Pilih Status Baru</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="relative">
                                <input type="radio" name="status" value="pending" class="sr-only peer" {{ $booking->status == 'pending' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:border-yellow-300 cursor-pointer transition-all duration-200 hover:shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition-all duration-200">
                                            <i class="fas fa-clock text-yellow-600 hover:text-yellow-700 transition-colors duration-200"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 hover:text-gray-800 transition-colors duration-200">Pending</div>
                                            <div class="text-xs text-gray-500 hover:text-gray-600 transition-colors duration-200">Menunggu review</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="status" value="approved" class="sr-only peer" {{ $booking->status == 'approved' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-green-300 cursor-pointer transition-all duration-200 hover:shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-green-100 hover:bg-green-200 flex items-center justify-center transition-all duration-200">
                                            <i class="fas fa-check text-green-600 hover:text-green-700 transition-colors duration-200"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 hover:text-gray-800 transition-colors duration-200">Approved</div>
                                            <div class="text-xs text-gray-500 hover:text-gray-600 transition-colors duration-200">Disetujui</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="status" value="rejected" class="sr-only peer" {{ $booking->status == 'rejected' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-red-300 cursor-pointer transition-all duration-200 hover:shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 hover:bg-red-200 flex items-center justify-center transition-all duration-200">
                                            <i class="fas fa-times text-red-600 hover:text-red-700 transition-colors duration-200"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 hover:text-gray-800 transition-colors duration-200">Rejected</div>
                                            <div class="text-xs text-gray-500 hover:text-gray-600 transition-colors duration-200">Ditolak</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="status" value="completed" class="sr-only peer" {{ $booking->status == 'completed' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300 cursor-pointer transition-all duration-200 hover:shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition-all duration-200">
                                            <i class="fas fa-check-double text-blue-600 hover:text-blue-700 transition-colors duration-200"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 hover:text-gray-800 transition-colors duration-200">Completed</div>
                                            <div class="text-xs text-gray-500 hover:text-gray-600 transition-colors duration-200">Selesai</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 hover:text-gray-800 transition-colors duration-200">
                            <span class="flex items-center space-x-2">
                                <i class="fas fa-sticky-note text-gray-400 hover:text-gray-500 transition-colors duration-200"></i>
                                <span>Catatan untuk Pemesan</span>
                            </span>
                        </label>
                        <textarea id="modal_notes" name="admin_notes" rows="3"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 hover:border-gray-400 transition-all duration-200 resize-none"
                                  placeholder="Berikan catatan atau instruksi...">{{ $booking->admin_notes ?? '' }}</textarea>
                        <p class="text-xs text-gray-500 hover:text-gray-600 mt-2 transition-colors duration-200">Catatan akan dikirimkan ke email pemesan</p>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <button type="button" onclick="hideModal()"
                                class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 rounded-lg transition-all duration-200 shadow-sm hover:shadow active:scale-[0.98]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function showModal() {
    const modal = document.getElementById('statusModal');
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function hideModal() {
    const modal = document.getElementById('statusModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Set form action
document.getElementById('statusForm').action = `/admin/bookings/{{ $booking->id }}/status`;

// Close modal on outside click
document.addEventListener('click', function(e) {
    const modal = document.getElementById('statusModal');
    if (e.target === modal) {
        hideModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideModal();
    }
});
</script>

<style>
/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Smooth transitions */
* {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Premium shadow effects */
.shadow-sm {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.shadow {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Gradient text */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Active button effect */
.active:scale-[0.98] {
    transform: scale(0.98);
}

/* Focus states */
input:focus, textarea:focus, select:focus {
    outline: none;
    ring: 2px;
}

/* Mobile optimizations */
@media (max-width: 640px) {
    .text-xs {
        font-size: 0.75rem;
    }
    .text-sm {
        font-size: 0.875rem;
    }
    .text-base {
        font-size: 1rem;
    }
    .text-lg {
        font-size: 1.125rem;
    }
    .text-xl {
        font-size: 1.25rem;
    }
    .text-2xl {
        font-size: 1.5rem;
    }
}

/* Card hover effects */
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Status badge hover effects */
.bg-yellow-50:hover {
    background-color: #fefce8;
}
.bg-green-50:hover {
    background-color: #f0fdf4;
}
.bg-red-50:hover {
    background-color: #fef2f2;
}
.bg-blue-50:hover {
    background-color: #eff6ff;
}
.bg-gray-50:hover {
    background-color: #f9fafb;
}
</style>
@endsection