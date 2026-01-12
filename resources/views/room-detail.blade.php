@extends('layouts.app')

@section('title', $room->name . ' - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Room Header -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="md:flex">
            <div class="md:w-2/3 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $room->name }}</h1>
                    <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full font-bold">
                        Rp {{ number_format($room->price_per_hour, 0, ',', '.') }}/jam
                    </span>
                </div>
                
                <p class="text-gray-600 mb-6">{{ $room->description }}</p>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-users text-red-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Kapasitas</p>
                            <p class="font-medium">{{ $room->capacity }} orang</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-red-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-5
00">Status</p>
                            <p class="font-medium">{{ $room->is_active ? 'Tersedia' : 'Tidak Tersedia' }}</p>
                        </div>
                    </div>
                </div>
                
                @auth
                    <a href="{{ route('booking.create', $room->slug) }}" class="inline-flex items-center bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                        <i class="fas fa-calendar-plus mr-2"></i> Booking Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login untuk Booking
                    </a>
                @endauth
            </div>
            
            <div class="md:w-1/3 bg-red-50 flex items-center justify-center p-8">
                <i class="fas fa-building text-red-400 text-8xl"></i>
            </div>
        </div>
    </div>
    
    <!-- Room Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Facilities -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Fasilitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php
                        $facilities = explode(',', $room->facilities);
                    @endphp
                    @foreach($facilities as $facility)
                        <div class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-gray-700">{{ trim($facility) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Booking Calendar -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Cek Ketersediaan</h2>
                <form id="roomAvailabilityForm" class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal</label>
                            <input type="date" id="roomDate" value="{{ $today }}" min="{{ $today }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div class="flex items-end">
                            <button type="button" onclick="checkRoomAvailability({{ $room->id }})" class="w-full bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                                <i class="fas fa-search mr-2"></i> Cek Jadwal
                            </button>
                        </div>
                    </div>
                </form>
                
                <div id="roomAvailabilityResult">
                    <!-- Availability result will be loaded here -->
                </div>
            </div>
        </div>
        
        <!-- Quick Info -->
        <div>
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Booking</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-clock text-red-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium">Durasi Minimal</p>
                            <p class="text-gray-600">2 jam</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-calendar-alt text-red-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium">Booking Maksimal</p>
                            <p class="text-gray-600">30 hari sebelumnya</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-money-bill-wave text-red-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium">Pembayaran</p>
                            <p class="text-gray-600">Setelah disetujui admin</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-file-alt text-red-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium">Persyaratan</p>
                            <p class="text-gray-600">Lihat SOP peminjaman</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('sop') }}" class="block w-full text-center mt-6 bg-red-50 text-red-600 px-4 py-3 rounded-lg hover:bg-red-100 font-medium">
                    <i class="fas fa-external-link-alt mr-2"></i> Lihat SOP Lengkap
                </a>
            </div>
            
            <!-- Similar Rooms -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Ruangan Serupa</h2>
    <div class="space-y-4">
        @if($rooms->count() > 0)
            @foreach($rooms as $similarRoom)
                <a href="{{ route('room.detail', $similarRoom->slug) }}" class="block p-4 border border-gray-200 rounded-lg hover:border-red-300 hover:bg-red-50 transition duration-300">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-800">{{ $similarRoom->name }}</h3>
                        <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded">Rp {{ number_format($similarRoom->price_per_hour, 0, ',', '.') }}/jam</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($similarRoom->description, 60) }}</p>
                </a>
            @endforeach
        @else
            <div class="text-center py-4">
                <i class="fas fa-building text-gray-300 text-3xl mb-2"></i>
                <p class="text-gray-500">Tidak ada ruangan serupa</p>
            </div>
        @endif
    </div>
</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function checkRoomAvailability(roomId) {
    const date = document.getElementById('roomDate').value;
    const resultDiv = document.getElementById('roomAvailabilityResult');
    
    if (!date) {
        alert('Silakan pilih tanggal terlebih dahulu');
        return;
    }
    
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
        let html = `
            <h3 class="text-lg font-bold text-gray-800 mb-4">Jadwal ${data.room.name}</h3>
            <p class="text-gray-600 mb-6">Tanggal: ${date}</p>
        `;
        
        if (data.booked_slots.length === 0) {
            html += `
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-4 text-3xl"></i>
                        <div>
                            <p class="font-bold text-green-800 text-xl">Ruangan Tersedia!</p>
                            <p class="text-green-600">Ruangan tersedia sepanjang hari pada tanggal tersebut.</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    @auth
                        <a href="{{ route('booking.create', $room->slug) }}?date=${date}" class="inline-flex items-center bg-red-600 text-white px-8 py-4 rounded-lg hover:bg-red-700 font-medium text-lg">
                            <i class="fas fa-calendar-plus mr-3"></i> Booking Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center bg-red-600 text-white px-8 py-4 rounded-lg hover:bg-red-700 font-medium text-lg">
                            <i class="fas fa-sign-in-alt mr-3"></i> Login untuk Booking
                        </a>
                    @endauth
                </div>
            `;
        } else {
            html += `
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-yellow-600 mr-3 text-xl"></i>
                        <div>
                            <p class="font-bold text-yellow-800">Ruangan sudah dibooking pada jam berikut:</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3 mb-8">
            `;
            
            // Sort slots by start time
            data.booked_slots.sort((a, b) => a.start.localeCompare(b.start));
            
            data.booked_slots.forEach(slot => {
                html += `
                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-times text-red-500 mr-4 text-xl"></i>
                            <div>
                                <p class="font-bold text-gray-800">${slot.start} - ${slot.end}</p>
                                <p class="text-sm text-gray-600">Sudah dibooking</p>
                            </div>
                        </div>
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-bold">Terisi</span>
                    </div>
                `;
            });
            
            html += `</div>`;
            
            // Show available slots
            const bookedSlots = data.booked_slots;
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
                    <div class="mb-6">
                        <h4 class="font-bold text-gray-800 mb-4">Slot Tersedia:</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                `;
                
                availableSlots.forEach(slot => {
                    html += `
                        <div class="bg-green-100 border border-green-200 rounded-lg p-3 text-center">
                            <p class="font-bold text-green-800">${slot.start} - ${slot.end}</p>
                            @auth
                                <a href="{{ route('booking.create', $room->slug) }}?date=${date}&start=${slot.start}&end=${slot.end}" class="inline-block mt-2 text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Pilih
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-block mt-2 text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Login
                                </a>
                            @endauth
                        </div>
                    `;
                });
                
                html += `</div></div>`;
            }
            
            html += `
                <div class="text-center">
                    <p class="text-gray-600 mb-4">Pilih slot tersedia untuk booking</p>
                    @auth
                        <a href="{{ route('booking.create', $room->slug) }}?date=${date}" class="inline-flex items-center bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-medium">
                            <i class="fas fa-calendar-plus mr-2"></i> Lanjutkan Booking
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-medium">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login untuk Booking
                        </a>
                    @endauth
                </div>
            `;
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

// Check availability on page load
document.addEventListener('DOMContentLoaded', function() {
    checkRoomAvailability({{ $room->id }});
});
</script>
@endsection