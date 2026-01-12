@extends('layouts.app')

@section('title', 'Sumedang Creative Center - Booking Ruangan')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-red-600 to-red-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Booking Ruangan Sumedang Creative Center</h1>
                <p class="text-xl mb-8">Temukan dan pesan ruangan kreatif untuk workshop, pertemuan, atau acara Anda dengan mudah dan cepat.</p>
                <a href="#rooms" class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition duration-300 inline-flex items-center">
                    <i class="fas fa-search mr-2"></i> Cari Ruangan
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 opacity-10">
            <i class="fas fa-building text-[300px]"></i>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-red-50 rounded-xl p-6 shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Cek Ketersediaan Ruangan</h2>
                <form id="availabilityForm" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2">Pilih Ruangan</label>
                        <select id="roomSelect" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Semua Ruangan</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Tanggal</label>
                        <input type="date" id="dateSelect" value="{{ $today }}" min="{{ $today }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div class="flex items-end">
                        <button type="button" onclick="checkAvailability()" class="w-full bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                            <i class="fas fa-calendar-check mr-2"></i> Cek Ketersediaan
                        </button>
                    </div>
                </form>
                <div id="availabilityResult" class="mt-6 hidden">
                    <!-- Results will be loaded here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Grid -->
    <section id="rooms" class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Daftar Ruangan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Pilih dari berbagai ruangan kreatif yang tersedia di Sumedang Creative Center</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms as $room)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="h-48 bg-red-100 flex items-center justify-center">
                            <i class="fas fa-building text-red-400 text-6xl"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ $room->name }}</h3>
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium">
                                    Rp {{ number_format($room->price_per_hour, 0, ',', '.') }}/jam
                                </span>
                            </div>
                            
                            <p class="text-gray-600 mb-4">{{ Str::limit($room->description, 100) }}</p>
                            
                            <div class="mb-4">
                                <div class="flex items-center text-gray-700 mb-2">
                                    <i class="fas fa-users mr-2 text-red-500"></i>
                                    <span>Kapasitas: {{ $room->capacity }} orang</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-wifi mr-2 text-red-500"></i>
                                    <span>Fasilitas: {{ Str::limit($room->facilities, 50) }}</span>
                                </div>
                            </div>
                            
                            <div class="flex space-x-3">
                                <a href="{{ route('room.detail', $room->slug) }}" class="flex-1 bg-red-600 text-white text-center px-4 py-3 rounded-lg hover:bg-red-700 font-medium">
                                    <i class="fas fa-info-circle mr-2"></i> Detail
                                </a>
                                @auth
                                    <a href="{{ route('booking.create', $room->slug) }}" class="flex-1 bg-white text-red-600 border border-red-600 text-center px-4 py-3 rounded-lg hover:bg-red-50 font-medium">
                                        <i class="fas fa-calendar-plus mr-2"></i> Booking
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="flex-1 bg-white text-red-600 border border-red-600 text-center px-4 py-3 rounded-lg hover:bg-red-50 font-medium">
                                        <i class="fas fa-calendar-plus mr-2"></i> Booking
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Cara Memesan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Langkah-langkah mudah untuk booking ruangan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">1. Cari Ruangan</h3>
                    <p class="text-gray-600">Pilih ruangan yang sesuai dengan kebutuhan Anda</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">2. Pilih Waktu</h3>
                    <p class="text-gray-600">Tentukan tanggal dan jam yang tersedia</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">3. Isi Form</h3>
                    <p class="text-gray-600">Lengkapi data dan tujuan penggunaan</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">4. Konfirmasi</h3>
                    <p class="text-gray-600">Tunggu konfirmasi dari admin</p>
                </div>
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
                <h3 class="text-lg font-bold text-gray-800 mb-4">Ketersediaan: ${data.room.name}</h3>
                <p class="text-gray-600 mb-4">Tanggal: ${date}</p>
            `;
            
            if (data.booked_slots.length === 0) {
                html += `
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-3 text-xl"></i>
                            <div>
                                <p class="font-bold text-green-800">Ruangan tersedia sepanjang hari!</p>
                                <p class="text-green-600">Anda dapat booking ruangan ini kapan saja pada tanggal tersebut.</p>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                html += `
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-600 mr-3 text-xl"></i>
                            <div>
                                <p class="font-bold text-yellow-800">Ruangan sudah dibooking pada jam berikut:</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 mb-6">
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
                    <a href="${data.room ? '/room/' + data.room.slug : '#'}" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                        <i class="fas fa-calendar-plus mr-2"></i> Booking Ruangan Ini
                    </a>
                </div>
            `;
        } else {
            // All rooms result
            html = '<h3 class="text-lg font-bold text-gray-800 mb-4">Ketersediaan Semua Ruangan</h3>';
            
            @foreach($rooms as $room)
                html += `
                    <div class="border border-gray-200 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-bold text-gray-800">{{ $room->name }}</h4>
                            <a href="/room/{{ $room->slug }}" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                Detail <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-users mr-2"></i>
                            <span>Kapasitas: {{ $room->capacity }} orang</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-medium">
                                Rp {{ number_format($room->price_per_hour, 0, ',', '.') }}/jam
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
                        <p class="font-bold text-red-800">Terjadi kesalahan</p>
                        <p class="text-red-600">Gagal memeriksa ketersediaan. Silakan coba lagi.</p>
                    </div>
                </div>
            </div>
        `;
    });
}
</script>
@endsection