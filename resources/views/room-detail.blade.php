@extends('layouts.app')

@section('title', $room->name . ' - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-6 md:py-8">
    <!-- Breadcrumb Navigation (Tetap) -->
    <nav class="mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-red-600 transition duration-300">
                    <i class="fas fa-home mr-1"></i> Beranda
                </a>
            </li>
            <li class="text-gray-400">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li>
                <a href="{{ url('/rooms') }}" class="text-gray-500 hover:text-red-600 transition duration-300">
                    Ruangan
                </a>
            </li>
            <li class="text-gray-400">
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="text-gray-700 font-medium truncate" aria-current="page">
                {{ $room->name }}
            </li>
        </ol>
    </nav>

    <!-- Room Header - Design Improved -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
        <div class="md:flex">
            <!-- Left Content -->
            <div class="md:w-2/3 p-6 md:p-8">
                <!-- Header with Status -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6">
                    <div>
                        <div class="flex items-center mb-3">
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-green-100 to-green-50 text-green-700 font-bold border border-green-200">
                                <i class="fas fa-handshake mr-2"></i> GRATIS
                            </span>
                            @if($room->is_active)
                                <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                    Tersedia
                                </span>
                            @else
                                <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $room->name }}</h1>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-8">
                    <p class="text-gray-700 text-lg leading-relaxed">{{ $room->description }}</p>
                </div>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100">
                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center mr-4">
                            <i class="fas fa-users text-red-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Kapasitas</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $room->capacity }} <span class="text-lg text-gray-600">orang</span></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100">
                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Durasi Min.</p>
                            <p class="text-2xl font-bold text-gray-900">2 <span class="text-lg text-gray-600">jam</span></p>
                        </div>
                    </div>
                </div>
                
                <!-- Action Button -->
                <div class="mb-6">
                    @auth
                        <a href="{{ route('booking.create', $room->slug) }}" 
                           class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-bold hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl shadow-lg">
                            <i class="fas fa-calendar-plus mr-3 text-lg"></i>
                            <span class="text-lg">Booking Sekarang</span>
                            <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-bold hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl shadow-lg">
                            <i class="fas fa-sign-in-alt mr-3 text-lg"></i>
                            <span class="text-lg">Login untuk Booking</span>
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Right Content - Room Icon -->
            <div class="md:w-1/3 bg-gradient-to-br from-red-50 to-white p-8 flex flex-col items-center justify-center border-t md:border-t-0 md:border-l border-gray-100">
                <div class="relative mb-6">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-red-600 rounded-full opacity-10 blur-xl"></div>
                    <div class="relative">
                        <i class="fas fa-building text-red-400 text-7xl"></i>
                    </div>
                </div>
                
                <div class="text-center">
                    <p class="text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                        Sumedang Creative Center
                    </p>
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 font-medium">
                        <i class="fas fa-star mr-2"></i>
                        Ruangan Premium
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Facilities Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-list-check text-red-500 mr-3"></i>
                        Fasilitas
                    </h2>
                    <span class="text-sm font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                        {{ count(explode(',', $room->facilities)) }} fasilitas
                    </span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                        $facilities = explode(',', $room->facilities);
                        $facilityIcons = [
                            'Proyektor' => 'fa-video',
                            'Whiteboard' => 'fa-chalkboard',
                            'Sound System' => 'fa-volume-up',
                            'AC' => 'fa-snowflake',
                            'Wi-Fi' => 'fa-wifi',
                            'Kursi' => 'fa-chair',
                            'Meja' => 'fa-table',
                            'Listrik' => 'fa-plug',
                            'Toilet' => 'fa-restroom',
                            'Parkir' => 'fa-parking',
                            'LED TV' => 'fa-tv',
                            'Microphone' => 'fa-microphone'
                        ];
                    @endphp
                    
                    @foreach($facilities as $facility)
                        @php
                            $facility = trim($facility);
                            $icon = $facilityIcons[$facility] ?? 'fa-check-circle';
                        @endphp
                        <div class="flex items-center p-4 rounded-xl bg-gray-50 border border-gray-100 hover:border-red-200 hover:bg-red-50 transition-all duration-300 group">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-r from-red-100 to-pink-100 flex items-center justify-center mr-4 group-hover:from-red-200 group-hover:to-pink-200 transition-all duration-300">
                                <i class="fas {{ $icon }} text-red-500"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $facility }}</h3>
                                <p class="text-sm text-gray-600 mt-1">Tersedia</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Availability Checker -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                    <i class="fas fa-calendar-alt text-red-500 mr-3"></i>
                    Cek Ketersediaan
                </h2>
                
                <!-- Date Picker -->
                <div class="mb-8">
                    <label class="block text-gray-700 font-medium mb-3">
                        <i class="far fa-calendar mr-2"></i>Pilih Tanggal
                    </label>
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="relative flex-1">
                            <input type="date" 
                                   id="roomDate" 
                                   value="{{ $today }}" 
                                   min="{{ $today }}" 
                                   max="{{ \Carbon\Carbon::parse($today)->addDays(30)->format('Y-m-d') }}"
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition duration-300 font-medium">
                            <i class="fas fa-calendar-day absolute left-4 top-1/2 transform -translate-y-1/2 text-red-400"></i>
                        </div>
                        <button type="button" 
                                onclick="checkRoomAvailability({{ $room->id }})" 
                                class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-search mr-3"></i>
                            Cek Jadwal
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 mt-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        Maksimal booking 30 hari ke depan
                    </p>
                </div>
                
                <!-- Availability Result -->
                <div id="roomAvailabilityResult" class="min-h-[200px]">
                    <div class="flex flex-col items-center justify-center h-full py-12">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mb-4"></div>
                        <p class="text-gray-600 font-medium">Memuat ketersediaan...</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column (1/3) -->
        <div class="space-y-8">
            <!-- Booking Information -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-clipboard-list text-red-500 mr-3"></i>
                    Informasi Booking
                </h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-red-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Jam Operasional</h3>
                            <p class="text-gray-600">08:00 - 22:00 WIB</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-4">
                            <i class="fas fa-hourglass-half text-green-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Durasi Minimal</h3>
                            <p class="text-gray-600">2 jam per sesi booking</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-4">
                            <i class="fas fa-calendar-times text-blue-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Booking Maksimal</h3>
                            <p class="text-gray-600">30 hari sebelumnya</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-4">
                            <i class="fas fa-file-alt text-purple-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Persyaratan</h3>
                            <p class="text-gray-600">Membawa KTP/Kartu Pelajar asli</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('sop') }}" 
                   class="inline-flex items-center justify-center w-full mt-8 px-6 py-3 rounded-xl border-2 border-red-600 text-red-600 font-semibold hover:bg-red-50 transition-all duration-300">
                    <i class="fas fa-external-link-alt mr-3"></i>
                    Lihat SOP Lengkap
                </a>
            </div>
            
            <!-- Similar Rooms -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-building-circle-check text-red-500 mr-3"></i>
                    Ruangan Serupa
                </h2>
                
                <div class="space-y-4">
                    @if($rooms && $rooms->count() > 0)
                        @foreach($rooms as $similarRoom)
                            @if($similarRoom->id != $room->id)
                                <a href="{{ route('room.detail', $similarRoom->slug) }}" 
                                   class="block p-4 rounded-xl border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all duration-300 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-r from-red-100 to-pink-100 flex items-center justify-center mr-4 group-hover:from-red-200 group-hover:to-pink-200 transition-all duration-300">
                                            <i class="fas fa-building text-red-500"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <h3 class="font-bold text-gray-900 group-hover:text-red-700 transition-colors duration-300">
                                                    {{ $similarRoom->name }}
                                                </h3>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-handshake mr-1 text-xs"></i> GRATIS
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 line-clamp-2">
                                                {{ Str::limit($similarRoom->description, 70) }}
                                            </p>
                                            <div class="flex items-center text-xs text-gray-500 mt-2">
                                                <i class="fas fa-users mr-1 text-gray-400"></i>
                                                <span>{{ $similarRoom->capacity }} orang</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @else
                        <div class="text-center py-6">
                            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-building text-gray-300"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada ruangan serupa</p>
                        </div>
                    @endif
                </div>
                
                <a href="{{ url('/rooms') }}" 
                   class="inline-flex items-center justify-center w-full mt-6 px-4 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition duration-300">
                    <i class="fas fa-list mr-2"></i>
                    Lihat Semua Ruangan
                </a>
            </div>
            
            <!-- Contact Support -->
            <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl shadow-lg p-6 border border-red-100">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-headset text-red-500 mr-3"></i>
                    Butuh Bantuan?
                </h3>
                <p class="text-gray-600 mb-6 text-sm">
                    Hubungi admin kami untuk pertanyaan seputar booking dan fasilitas ruangan.
                </p>
                <div class="space-y-3">
                    <a href="tel:+6222312345678" 
                       class="flex items-center justify-center px-4 py-2.5 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition duration-300 text-sm">
                        <i class="fas fa-phone mr-2"></i>
                        (022) 1234-5678
                    </a>
                    <a href="mailto:admin@sumedangcreative.id" 
                       class="flex items-center justify-center px-4 py-2.5 rounded-lg border border-red-600 text-red-600 font-medium hover:bg-red-50 transition duration-300 text-sm">
                        <i class="fas fa-envelope mr-2"></i>
                        Email Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button for Mobile -->
<div class="lg:hidden fixed bottom-6 right-6 z-50">
    @auth
        <a href="{{ route('booking.create', $room->slug) }}" 
           class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-red-600 to-red-700 text-white shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-calendar-plus text-xl"></i>
        </a>
    @else
        <a href="{{ route('login') }}" 
           class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-red-600 to-red-700 text-white shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-sign-in-alt text-xl"></i>
        </a>
    @endauth
</div>
@endsection

@section('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease;
    }
    
    /* Hover effects */
    .hover\:shadow-xl:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection

@section('scripts')
<script>
// Fungsi untuk memeriksa ketersediaan ruangan
function checkRoomAvailability(roomId) {
    const date = document.getElementById('roomDate').value;
    const resultDiv = document.getElementById('roomAvailabilityResult');
    
    if (!date) {
        showNotification('Silakan pilih tanggal terlebih dahulu', 'warning');
        return;
    }
    
    // Tampilkan loading state
    resultDiv.innerHTML = `
        <div class="flex flex-col items-center justify-center h-full py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Memeriksa ketersediaan...</p>
        </div>
    `;
    
    fetch('{{ route("check.availability") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ room_id: roomId, date: date })
    })
    .then(response => response.json())
    .then(data => {
        renderAvailabilityResult(data, date, roomId);
    })
    .catch(error => {
        console.error('Error:', error);
        resultDiv.innerHTML = `
            <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-red-800 mb-1">Terjadi Kesalahan</h3>
                        <p class="text-red-600 text-sm">Gagal memeriksa ketersediaan. Silakan coba lagi.</p>
                    </div>
                </div>
                <button onclick="checkRoomAvailability(${roomId})" 
                        class="mt-4 inline-flex items-center px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition duration-300">
                    <i class="fas fa-redo mr-2"></i>
                    Coba Lagi
                </button>
            </div>
        `;
    });
}

// Render hasil ketersediaan
function renderAvailabilityResult(data, date, roomId) {
    const resultDiv = document.getElementById('roomAvailabilityResult');
    const bookedSlots = data.booked_slots || [];
    
    // Format tanggal untuk tampilan
    const formattedDate = new Date(date).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    let html = '';
    
    // Header
    html += `
        <div class="mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Ketersediaan ${data.room?.name || 'Ruangan'}</h3>
            <div class="flex items-center text-gray-600 text-sm">
                <i class="far fa-calendar mr-2"></i>
                <span>${formattedDate}</span>
            </div>
        </div>
    `;
    
    if (bookedSlots.length === 0) {
        // Ruangan tersedia sepanjang hari
        html += `
            <div class="mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-800 text-lg mb-1">Ruangan Tersedia!</h4>
                            <p class="text-green-700 text-sm">Seluruh slot waktu tersedia pada tanggal ini.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Available Time Slots -->
            <div class="mb-8">
                <h4 class="font-bold text-gray-900 mb-4">Slot Waktu Tersedia:</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        `;
        
        const timeSlots = [
            { start: '08:00', end: '10:00' },
            { start: '10:00', end: '12:00' },
            { start: '12:00', end: '14:00' },
            { start: '14:00', end: '16:00' },
            { start: '16:00', end: '18:00' },
            { start: '18:00', end: '20:00' },
            { start: '20:00', end: '22:00' }
        ];
        
        timeSlots.forEach(slot => {
            html += `
                <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                    <p class="font-bold text-green-800 text-sm">${slot.start} - ${slot.end}</p>
                    @auth
                        <a href="{{ route('booking.create', $room->slug) }}?date=${date}&start=${slot.start}&end=${slot.end}" 
                           class="inline-block mt-2 text-xs bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition duration-300">
                            Pilih
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-block mt-2 text-xs bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition duration-300">
                            Login
                        </a>
                    @endauth
                </div>
            `;
        });
        
        html += `
                </div>
            </div>
        `;
    } else {
        // Ada slot yang sudah dibooking
        html += `
            <div class="mb-6">
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-yellow-800 mb-1">Ruangan Tersedia Sebagian</h4>
                            <p class="text-yellow-700 text-sm">Beberapa slot waktu sudah dibooking.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booked Slots -->
            <div class="mb-6">
                <h4 class="font-bold text-gray-900 mb-3">Slot Terbooking:</h4>
                <div class="space-y-3">
        `;
        
        // Sort booked slots by start time
        bookedSlots.sort((a, b) => a.start.localeCompare(b.start));
        
        bookedSlots.forEach(slot => {
            const startTime = slot.start.substring(0, 5);
            const endTime = slot.end.substring(0, 5);
            
            html += `
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center mr-3">
                            <i class="fas fa-ban text-red-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">${startTime} - ${endTime}</p>
                            <p class="text-xs text-gray-600">Sudah dibooking</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Terisi
                    </span>
                </div>
            `;
        });
        
        html += `
                </div>
            </div>
            
            <!-- Available Slots -->
            <div class="mb-6">
                <h4 class="font-bold text-gray-900 mb-3">Slot Tersedia:</h4>
        `;
        
        // Calculate available slots
        const allSlots = [
            { start: '08:00', end: '10:00' },
            { start: '10:00', end: '12:00' },
            { start: '12:00', end: '14:00' },
            { start: '14:00', end: '16:00' },
            { start: '16:00', end: '18:00' },
            { start: '18:00', end: '20:00' },
            { start: '20:00', end: '22:00' }
        ];
        
        const availableSlots = allSlots.filter(slot => {
            return !bookedSlots.some(booked => {
                return (slot.start >= booked.start && slot.start < booked.end) ||
                       (slot.end > booked.start && slot.end <= booked.end) ||
                       (slot.start <= booked.start && slot.end >= booked.end);
            });
        });
        
        if (availableSlots.length > 0) {
            html += `
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            `;
            
            availableSlots.forEach(slot => {
                html += `
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                        <p class="font-bold text-green-800 text-sm">${slot.start} - ${slot.end}</p>
                        @auth
                            <a href="{{ route('booking.create', $room->slug) }}?date=${date}&start=${slot.start}&end=${slot.end}" 
                               class="inline-block mt-2 text-xs bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition duration-300">
                                Pilih
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="inline-block mt-2 text-xs bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition duration-300">
                                Login
                            </a>
                        @endauth
                    </div>
                `;
            });
            
            html += `</div>`;
        } else {
            html += `
                <div class="text-center py-6 bg-gray-50 rounded-lg">
                    <i class="fas fa-calendar-times text-gray-300 text-3xl mb-3"></i>
                    <p class="text-gray-600 font-medium">Tidak ada slot tersedia</p>
                    <p class="text-gray-500 text-sm mt-1">Coba tanggal lain</p>
                </div>
            `;
        }
        
        html += `</div>`;
    }
    
    // Action Buttons
    html += `
        <div class="pt-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row gap-3">
                @auth
                    <a href="{{ route('booking.create', $room->slug) }}?date=${date}" 
                       class="inline-flex items-center justify-center flex-1 px-4 py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-300 text-sm">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Lanjutkan Booking
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center justify-center flex-1 px-4 py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-300 text-sm">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login untuk Booking
                    </a>
                @endauth
                
                <button onclick="checkRoomAvailability(${roomId})" 
                        class="inline-flex items-center justify-center flex-1 px-4 py-3 rounded-xl border border-red-600 text-red-600 font-semibold hover:bg-red-50 transition duration-300 text-sm">
                    <i class="fas fa-redo mr-2"></i>
                    Cek Tanggal Lain
                </button>
            </div>
        </div>
    `;
    
    resultDiv.innerHTML = html;
}

// Notification function
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-4 rounded-xl shadow-xl z-[100] transform translate-x-full opacity-0 transition-all duration-500 ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
    } text-white`;
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} mr-3"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full', 'opacity-0');
        notification.classList.add('translate-x-0', 'opacity-100');
    }, 10);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        notification.classList.remove('translate-x-0', 'opacity-100');
        notification.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => notification.remove(), 500);
    }, 4000);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check availability on page load
    checkRoomAvailability({{ $room->id }});
    
    // Add visual feedback for date picker
    const dateInput = document.getElementById('roomDate');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            this.classList.add('ring-2', 'ring-red-300');
            setTimeout(() => {
                this.classList.remove('ring-2', 'ring-red-300');
            }, 1000);
        });
    }
});
</script>
@endsection