@extends('layouts.app')

@section('title', 'Booking Ruangan - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-bold">
                        1
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-800">Pilih Ruangan</p>
                        <p class="text-sm text-gray-600">Selesai</p>
                    </div>
                </div>
                
                <div class="h-1 flex-1 bg-red-600 mx-4"></div>
                
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-bold">
                        2
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-800">Isi Data Booking</p>
                        <p class="text-sm text-gray-600">Langkah saat ini</p>
                    </div>
                </div>
                
                <div class="h-1 flex-1 bg-gray-200 mx-4"></div>
                
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold">
                        3
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-400">Konfirmasi</p>
                        <p class="text-sm text-gray-400">Selanjutnya</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Room Info -->
            <div>
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6 sticky top-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $room->name }}</h3>
                    
                    <div class="mb-6">
                        <div class="h-48 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-building text-red-400 text-6xl"></i>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kapasitas</span>
                                <span class="font-medium">{{ $room->capacity }} orang</span>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-bold text-gray-800 mb-2">Fasilitas:</h4>
                        <div class="space-y-2">
                            @php
                                $facilities = explode(',', $room->facilities);
                            @endphp
                            @foreach($facilities as $facility)
                                <div class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2 text-sm"></i>
                                    <span class="text-sm text-gray-600">{{ trim($facility) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Booking Ruangan</h2>
                    
                    <form method="POST" action="{{ route('booking.store') }}" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="space-y-6">
                            <!-- Date Selection -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Tanggal Booking *</label>
                                <input type="date" name="booking_date" id="booking_date" 
                                       value="{{ request()->get('date') ?? date('Y-m-d') }}"
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                                @error('booking_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Time Selection -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Waktu Mulai *</label>
                                    <select name="start_time" id="start_time" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                                        <option value="">Pilih waktu mulai</option>
                                        @php
                                            $start = 8;
                                            $end = 22;
                                        @endphp
                                        @for($i = $start; $i < $end; $i++)
                                            @php
                                                $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                                            @endphp
                                            <option value="{{ $time }}" {{ request()->get('start') == $time ? 'selected' : '' }}>
                                                {{ $time }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('start_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Waktu Selesai *</label>
                                    <select name="end_time" id="end_time" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                                        <option value="">Pilih waktu selesai</option>
                                        @for($i = $start + 2; $i <= $end; $i++)
                                            @php
                                                $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                                            @endphp
                                            <option value="{{ $time }}" {{ request()->get('end') == $time ? 'selected' : '' }}>
                                                {{ $time }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('end_time')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Time Examples -->
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 mb-2">
                                    <i class="fas fa-info-circle text-red-500 mr-1"></i>
                                    <strong>Contoh pilihan waktu yang valid:</strong>
                                </p>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                    <div class="bg-green-50 p-2 rounded text-center">
                                        <p class="text-xs font-medium text-green-800">08:00 - 10:00</p>
                                        <p class="text-xs text-green-600">2 jam</p>
                                    </div>
                                    <div class="bg-green-50 p-2 rounded text-center">
                                        <p class="text-xs font-medium text-green-800">09:00 - 11:00</p>
                                        <p class="text-xs text-green-600">2 jam</p>
                                    </div>
                                    <div class="bg-green-50 p-2 rounded text-center">
                                        <p class="text-xs font-medium text-green-800">14:00 - 16:00</p>
                                        <p class="text-xs text-green-600">2 jam</p>
                                    </div>
                                    <div class="bg-blue-50 p-2 rounded text-center">
                                        <p class="text-xs font-medium text-blue-800">08:00 - 11:00</p>
                                        <p class="text-xs text-blue-600">3 jam</p>
                                    </div>
                                    <div class="bg-blue-50 p-2 rounded text-center">
                                        <p class="text-xs font-medium text-blue-800">13:00 - 17:00</p>
                                        <p class="text-xs text-blue-600">4 jam</p>
                                    </div>
                                    <div class="bg-purple-50 p-2 rounded text-center">
                                        <p class="text-xs font-medium text-purple-800">08:00 - 12:00</p>
                                        <p class="text-xs text-purple-600">4 jam</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Duration Info -->
                            <div id="duration_info" class="hidden">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-blue-800">Durasi Booking: <span id="duration_hours">0</span> jam</p>
                                            <p class="text-sm text-blue-600">Total: <span id="total_price">Rp 0</span></p>
                                        </div>
                                        <div id="duration_status"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Purpose -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Tujuan Penggunaan *</label>
                                <textarea name="purpose" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                                          placeholder="Jelaskan tujuan penggunaan ruangan (misal: workshop, rapat, latihan, dll)" required></textarea>
                                @error('purpose')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- User Info -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Data Pemesan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-gray-600 mb-1">Nama</p>
                                        <p class="font-medium">{{ auth()->user()->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 mb-1">Email</p>
                                        <p class="font-medium">{{ auth()->user()->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 mb-1">Telepon</p>
                                        <p class="font-medium">{{ auth()->user()->phone }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 mb-1">Alamat</p>
                                        <p class="font-medium">{{ auth()->user()->address }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Terms -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start">
                                    <input type="checkbox" id="terms" name="terms" required
                                           class="mt-1 mr-3 h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                    <label for="terms" class="text-sm text-gray-700">
                                        Saya menyetujui SOP peminjaman ruangan dan bertanggung jawab penuh atas penggunaan ruangan sesuai dengan peraturan yang berlaku. 
                                        Saya juga setuju untuk membayar biaya sesuai dengan durasi penggunaan.
                                    </label>
                                </div>
                                @error('terms')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-4">
                                <a href="{{ route('room.detail', $room->slug) }}" class="flex-1 bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-medium text-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </a>
                                <button type="submit" id="submitBtn" class="flex-1 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 font-medium">
                                    <i class="fas fa-paper-plane mr-2"></i> Submit Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Important Notes -->
                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-500 rounded-r-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-yellow-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Perhatian</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Booking akan diproses setelah admin melakukan konfirmasi (maksimal 24 jam)</li>
                                    <li>Pastikan data yang diisi sudah benar sebelum submit</li>
                                    <li><strong>Durasi minimal booking adalah 2 jam (contoh: 08:00 - 10:00)</strong></li>
                                    <li>Pilih waktu selesai minimal 2 jam setelah waktu mulai</li>
                                    <li>Pembayaran dilakukan setelah booking disetujui</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// HAPUS baris ini - tidak diperlukan lagi
// const pricePerHour = {{ $room->price_per_hour }};

function calculateDuration() {
    const startTime = document.getElementById('start_time').value;
    const endTime = document.getElementById('end_time').value;
    const date = document.getElementById('booking_date').value;
    const durationDiv = document.getElementById('duration_info');
    const durationStatus = document.getElementById('duration_status');
    
    if (startTime && endTime && date) {
        // Parse waktu dengan benar
        const start = new Date(date + 'T' + startTime + ':00');
        const end = new Date(date + 'T' + endTime + ':00');
        
        // Hitung dalam menit untuk presisi
        const diffMinutes = (end - start) / (1000 * 60);
        const diffHours = diffMinutes / 60;
        
        console.log('Duration calculation:', {
            startTime, endTime, diffMinutes, diffHours
        });
        
        if (diffHours >= 1.99) { // 1.99 untuk toleransi floating point
            document.getElementById('duration_hours').textContent = diffHours.toFixed(2);
            // HAPUS baris berikut karena tidak ada harga per jam lagi
            // document.getElementById('total_price').textContent = 'Rp ' + (diffHours * pricePerHour).toLocaleString('id-ID');
            
            // Update status durasi dengan warna yang sesuai
            let statusText, statusClass, boxClass;
            
            if (Math.abs(diffHours - 2) < 0.01) {
                // Tepat 2 jam
                statusText = '<i class="fas fa-check-circle mr-1"></i> Sesuai';
                statusClass = 'px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded';
                boxClass = 'bg-green-50 border border-green-200 rounded-lg p-4';
            } else {
                // Lebih dari 2 jam
                statusText = '<i class="fas fa-clock mr-1"></i> ' + diffHours.toFixed(2) + ' jam';
                statusClass = 'px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded';
                boxClass = 'bg-blue-50 border border-blue-200 rounded-lg p-4';
            }
            
            durationDiv.className = boxClass;
            durationDiv.classList.remove('hidden');
            durationStatus.innerHTML = `<span class="${statusClass}">${statusText}</span>`;
            
        } else {
            durationDiv.classList.add('hidden');
            if (diffHours > 0) {
                // Tampilkan pesan error yang jelas
                const errorMsg = `Durasi minimal booking adalah 2 jam. Anda memilih ${diffHours.toFixed(2)} jam.\n\nPilih waktu selesai minimal 2 jam setelah waktu mulai.\nContoh:\n• Jika mulai 08:00, pilih 10:00 atau lebih`;
                alert(errorMsg);
                
                // Reset end time
                document.getElementById('end_time').value = '';
            }
        }
    } else {
        durationDiv.classList.add('hidden');
    }
}

// Generate end time options yang valid
document.getElementById('start_time').addEventListener('change', function() {
    const endSelect = document.getElementById('end_time');
    const startTime = this.value;
    
    // Clear end time options
    endSelect.innerHTML = '<option value="">Pilih waktu selesai</option>';
    
    if (startTime) {
        const startHour = parseInt(startTime.split(':')[0]);
        
        // Generate options setiap jam
        for (let hour = startHour + 2; hour <= 22; hour++) {
            const time = hour.toString().padStart(2, '0') + ':00';
            const option = document.createElement('option');
            option.value = time;
            
            // Hitung durasi untuk label
            const startDate = new Date(`2000-01-01T${startTime}:00`);
            const endDate = new Date(`2000-01-01T${time}:00`);
            const diffHours = (endDate - startDate) / (1000 * 60 * 60);
            
            if (diffHours >= 2) {
                // Tambahkan label durasi
                if (diffHours === 2) {
                    option.textContent = `${time} (Tepat 2 jam)`;
                    option.style.fontWeight = 'bold';
                    option.style.color = '#059669'; // green-600
                } else if (diffHours === 3) {
                    option.textContent = `${time} (3 jam)`;
                } else if (diffHours === 4) {
                    option.textContent = `${time} (4 jam)`;
                } else {
                    option.textContent = time;
                }
                
                endSelect.appendChild(option);
            }
        }
        
        // Jika tidak ada option, tambahkan pesan
        if (endSelect.options.length === 1) {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Tidak ada slot waktu yang tersedia';
            option.disabled = true;
            endSelect.appendChild(option);
        }
    }
    
    calculateDuration();
});

document.getElementById('end_time').addEventListener('change', calculateDuration);
document.getElementById('booking_date').addEventListener('change', calculateDuration);

// Form validation sebelum submit
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const startTime = document.getElementById('start_time').value;
    const endTime = document.getElementById('end_time').value;
    
    if (startTime && endTime) {
        const start = new Date('2000-01-01T' + startTime + ':00');
        const end = new Date('2000-01-01T' + endTime + ':00');
        const diffHours = (end - start) / (1000 * 60 * 60);
        
        if (diffHours < 1.99) {
            e.preventDefault();
            alert(`❌ Durasi booking tidak valid!\n\nDurasi minimal adalah 2 jam.\nAnda memilih: ${diffHours.toFixed(2)} jam\n\nPilih waktu selesai minimal 2 jam setelah waktu mulai.`);
            return false;
        }
        
        // Show loading
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds jika form tidak submit
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    }
});

// Initialize jika ada prefilled values
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('start_time').value && document.getElementById('end_time').value) {
        calculateDuration();
    }
    
    // Highlight contoh waktu yang baik
    const startSelect = document.getElementById('start_time');
    Array.from(startSelect.options).forEach(option => {
        if (option.value === '08:00' || option.value === '09:00' || option.value === '14:00') {
            option.style.fontWeight = '600';
        }
    });
});
</script>

<style>
/* Style untuk option yang direkomendasikan */
select option[value="08:00"],
select option[value="09:00"], 
select option[value="14:00"] {
    font-weight: 600;
    color: #dc2626; /* red-600 */
}

select option:disabled {
    color: #9ca3af; /* gray-400 */
    font-style: italic;
}
</style>
@endsection