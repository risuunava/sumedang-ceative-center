@extends('layouts.app')

@section('title', 'Sumedang Creative Center | Ruang Kreatif Premium')

@section('content')
    <!-- Hero Section dengan Grid Rapi -->
    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-red-900 overflow-hidden">
        <div class="container mx-auto px-4 py-16 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Content -->
                <div class="relative z-10 ml-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-8 border border-white/20">
                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                        <span class="text-white text-sm font-medium">PREMIUM CREATIVE HUB</span>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-6 leading-tight">
                        <span class="block">Sumedang</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-red-300 via-red-200 to-red-100">
                            Creative Center
                        </span>
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-lg text-white/90 mb-8 leading-relaxed max-w-lg">
                        Pusat inovasi digital dan ruang kreatif premium untuk mengembangkan potensi masyarakat Sumedang. 
                        Fasilitas canggih tanpa biaya untuk mendukung ekosistem kreator lokal.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <a href="#rooms" 
                           class="inline-flex items-center justify-center bg-white text-red-700 px-6 py-3.5 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                            <i class="fas fa-compass mr-3"></i>Explore Facilities
                        </a>
                        <a href="#booking" 
                           class="inline-flex items-center justify-center border-2 border-white text-white px-6 py-3.5 rounded-lg font-semibold hover:bg-white/10 transition-colors duration-200">
                            <i class="fas fa-calendar-plus mr-3"></i>Book Now
                        </a>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-lg text-center border border-white/10">
                            <div class="text-2xl font-bold text-white mb-1">{{ count($rooms) }}+</div>
                            <div class="text-white/70 text-sm">Rooms</div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-lg text-center border border-white/10">
                            <div class="text-2xl font-bold text-white mb-1">100%</div>
                            <div class="text-white/70 text-sm">Free</div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-lg text-center border border-white/10">
                            <div class="text-2xl font-bold text-white mb-1">24/7</div>
                            <div class="text-white/70 text-sm">Booking</div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-lg text-center border border-white/10">
                            <div class="text-2xl font-bold text-white mb-1">4.9★</div>
                            <div class="text-white/70 text-sm">Rating</div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </section>

    <!-- Features Section dengan Grid Rapi -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <span class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    WHY CHOOSE US
                </span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Premium Features</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Dilengkapi teknologi terkini untuk mendukung kreativitas tanpa batas
                </p>
            </div>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-red-200 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-wifi text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">High-Speed Internet</h3>
                    <p class="text-gray-600">Koneksi fiber optic 1Gbps untuk produktivitas maksimal</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-red-200 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-video text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Studio Production</h3>
                    <p class="text-gray-600">Studio lengkap dengan peralatan profesional terbaik</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-red-200 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users-cog text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Smart Meeting</h3>
                    <p class="text-gray-600">Sistem meeting cerdas dengan teknologi IoT</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section dengan Grid Rapi -->
    <section id="booking" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Check Availability</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Sistem pemesanan pintar dengan teknologi real-time
                </p>
            </div>
            
            <!-- Booking Card -->
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 md:p-8">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Real-time Availability Check</h3>
                        <p class="text-gray-600 text-sm">Check availability in seconds</p>
                    </div>
                </div>
                
                <!-- Form Grid -->
                <form id="availabilityForm" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Room Select -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Select Room</label>
                            <select id="roomSelect" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-colors duration-200">
                                <option value="">All Available Rooms</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Date Select -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Select Date</label>
                            <input type="date" id="dateSelect" value="{{ $today }}" min="{{ $today }}" 
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-colors duration-200">
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex items-end">
                            <button type="button" onclick="checkAvailability()" 
                                    class="w-full bg-red-600 text-white px-6 py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors duration-200">
                                <i class="fas fa-search mr-2"></i>Check Availability
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Results Area -->
                <div id="availabilityResult" class="mt-6 hidden">
                    <!-- Results will be loaded here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section dengan Grid Rapi -->
    <section id="rooms" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <span class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    PREMIUM SPACES
                </span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Our Facilities</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pilih dari koleksi ruangan kreatif kami yang dirancang khusus
                </p>
            </div>
            
            <!-- Rooms Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                <div class="bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200 overflow-hidden">
                    <!-- Room Header -->
<div class="h-48 relative overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        @if(file_exists(storage_path('app/public/rooms/' . $room->image)))
            <img 
                src="{{ asset('storage/rooms/' . $room->image) }}" 
                alt="{{ $room->name }}"
                class="w-full h-full object-cover"
            >
        @else
            <!-- Fallback jika gambar tidak ditemukan -->
            <div class="w-full h-full bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center">
                <i class="fas fa-building text-white/20 text-6xl"></i>
            </div>
        @endif
        
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent"></div>
    </div>
    
    <!-- Capacity Badge -->
    <div class="absolute top-4 right-4 bg-white/90 px-3 py-1.5 rounded-full z-10">
        <span class="text-red-700 font-semibold text-sm flex items-center">
            <i class="fas fa-users mr-1.5"></i>{{ $room->capacity }} People
        </span>
    </div>
    
    <!-- Free Badge -->
    <div class="absolute bottom-4 left-4 z-10">
        <span class="bg-white text-red-700 font-semibold px-3 py-1.5 rounded-full text-sm shadow-sm">
            <i class="fas fa-gift mr-1.5"></i>FREE
        </span>
    </div>
</div>
                    
                    <!-- Room Content -->
                    <div class="p-6">
                        <!-- Title & Rating -->
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $room->name }}</h3>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm mr-1"></i>
                                <span class="text-gray-600 text-sm">4.8</span>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ Str::limit($room->description, 100) }}
                        </p>
                        
                        <!-- Facilities -->
                        <div class="mb-6">
                            <div class="flex items-center text-gray-700 mb-2">
                                <i class="fas fa-wifi text-red-500 mr-3"></i>
                                <span class="text-sm">{{ Str::limit($room->facilities, 50) }}</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('room.detail', $room->slug) }}" 
                               class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg font-medium hover:bg-gray-200 transition-colors duration-200 text-center">
                                <i class="fas fa-eye mr-2"></i>Details
                            </a>
                            
                            @auth
                                <a href="{{ route('booking.create', $room->slug) }}" 
                                   class="bg-red-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-red-700 transition-colors duration-200 text-center">
                                    <i class="fas fa-calendar-plus mr-2"></i>Book Now
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="bg-red-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-red-700 transition-colors duration-200 text-center">
                                    <i class="fas fa-calendar-plus mr-2"></i>Book Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process Section dengan Grid Rapi -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">How to Book</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Proses booking yang mudah dan cepat dalam 4 langkah sederhana
                </p>
            </div>
            
            <!-- Process Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach([
                    ['icon' => 'search', 'title' => 'Pilih Ruangan', 'desc' => 'Pilih ruangan yang sesuai'],
                    ['icon' => 'calendar-alt', 'title' => 'Pilih Waktu', 'desc' => 'Tentukan tanggal dan jam'],
                    ['icon' => 'file-alt', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data'],
                    ['icon' => 'check-circle', 'title' => 'Konfirmasi', 'desc' => 'Tunggu konfirmasi']
                ] as $index => $step)
                <div class="bg-white p-6 rounded-xl border border-gray-200 text-center">
                    <!-- Step Number -->
                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-semibold">
                        {{ $index + 1 }}
                    </div>
                    
                    <!-- Icon -->
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-{{ $step['icon'] }} text-red-600 text-lg"></i>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
function checkAvailability() {
    const roomId = document.getElementById('roomSelect').value;
    const date = document.getElementById('dateSelect').value;
    const resultDiv = document.getElementById('availabilityResult');
    
    if (!date) {
        alert('Silakan pilih tanggal terlebih dahulu');
        return;
    }
    
    resultDiv.classList.remove('hidden');
    resultDiv.innerHTML = `
        <div class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-red-600 text-2xl"></i>
            <p class="mt-2 text-gray-600">Memeriksa ketersediaan...</p>
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
        let html = '';
        
        if (roomId) {
            // Single room result
            html = `
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Ketersediaan: ${data.room.name}</h3>
                    <p class="text-gray-600 mb-6">Tanggal: ${date}</p>
            `;
            
            if (data.booked_slots.length === 0) {
                html += `
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-3 text-xl"></i>
                            <div>
                                <p class="font-semibold text-green-800">Ruangan tersedia sepanjang hari!</p>
                                <p class="text-green-600 text-sm">Anda dapat booking ruangan ini kapan saja pada tanggal tersebut.</p>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                html += `
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-600 mr-3 text-xl"></i>
                            <div>
                                <p class="font-semibold text-yellow-800">Ruangan sudah dibooking pada jam berikut:</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3 mb-6">
                `;
                
                data.booked_slots.forEach(slot => {
                    html += `
                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-times text-red-500 mr-3"></i>
                                <span class="font-medium">${slot.start} - ${slot.end}</span>
                            </div>
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">Booked</span>
                        </div>
                    `;
                });
                
                html += `</div>`;
            }
            
            if (!data.room) {
                const rooms = @json($rooms);
                rooms.forEach(room => {
                    if (room.id == roomId) {
                        data.room = room;
                    }
                });
            }
            
            html += `
                <div class="text-center">
                    <a href="${data.room ? '/room/' + data.room.slug : '#'}" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700">
                        <i class="fas fa-calendar-plus mr-2"></i> Booking Ruangan Ini
                    </a>
                </div>
            `;
            
            html += `</div>`;
        } else {
            // All rooms result
            html = '<h3 class="text-lg font-semibold text-gray-800 mb-4">Ketersediaan Semua Ruangan</h3>';
            
            @foreach($rooms as $room)
                html += `
                    <div class="border border-gray-200 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-semibold text-gray-800">{{ $room->name }}</h4>
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm">GRATIS</span>
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-users mr-2"></i>
                            <span>Kapasitas: {{ $room->capacity }} orang</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">
                                {{ Str::limit($room->description, 50) }}
                            </span>
                            <a href="/room/{{ $room->slug }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
                                Cek Jadwal
                            </a>
                        </div>
                    </div>
                `;
            @endforeach
        }
        
        resultDiv.innerHTML = html;
    })
    .catch(error => {
        console.error('Error:', error);
        resultDiv.innerHTML = `
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 mr-3 text-xl"></i>
                    <div>
                        <p class="font-semibold text-red-800">Terjadi kesalahan</p>
                        <p class="text-red-600 text-sm">Gagal memeriksa ketersediaan. Silakan coba lagi.</p>
                    </div>
                </div>
            </div>
        `;
    });
}
</script>

<style>
/* Line clamp untuk text */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth transitions */
* {
    transition: all 0.2s ease;
}

/* Grid spacing consistency */
.grid > * {
    min-width: 0;
}

/* Hero section improvements */
@media (max-width: 768px) {
    .hero-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection