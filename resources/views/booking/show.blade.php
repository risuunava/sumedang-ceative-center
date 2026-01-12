@extends('layouts.app')

@section('title', 'Detail Booking - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Detail Booking</h1>
                    <p class="text-gray-600">Kode Booking: {{ $booking->booking_code }}</p>
                </div>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.bookings') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Admin
                    </a>
                @else
                    <a href="{{ route('booking.index') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Booking Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <!-- Status Header -->
            <div class="px-6 py-4 {{ 
                $booking->status === 'pending' ? 'bg-yellow-100 border-l-4 border-yellow-500' :
                ($booking->status === 'approved' ? 'bg-green-100 border-l-4 border-green-500' :
                ($booking->status === 'rejected' ? 'bg-red-100 border-l-4 border-red-500' :
                ($booking->status === 'completed' ? 'bg-blue-100 border-l-4 border-blue-500' : 'bg-gray-100 border-l-4 border-gray-500')))
            }}">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Status: {{ strtoupper($booking->status) }}</h2>
                        <p class="text-gray-600">Dibuat: {{ $booking->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-bold {{ 
                        $booking->status === 'pending' ? 'bg-yellow-500 text-white' :
                        ($booking->status === 'approved' ? 'bg-green-500 text-white' :
                        ($booking->status === 'rejected' ? 'bg-red-500 text-white' :
                        ($booking->status === 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white')))
                    }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
            
            <!-- Booking Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Room Info -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Ruangan</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama Ruangan</p>
                                <p class="text-lg font-medium text-gray-800">{{ $booking->room->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kapasitas</p>
                                <p class="text-lg font-medium text-gray-800">{{ $booking->room->capacity }} orang</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fasilitas</p>
                                <p class="text-gray-700">{{ $booking->room->facilities }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Harga per Jam</p>
                                <p class="text-lg font-medium text-red-600">
                                    Rp {{ number_format($booking->room->price_per_hour, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Booking Schedule -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Jadwal Booking</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal</p>
                                <p class="text-lg font-medium text-gray-800">
                                    {{ $booking->booking_date->format('d F Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Waktu</p>
                                <p class="text-lg font-medium text-gray-800">
                                    {{ $booking->start_time }} - {{ $booking->end_time }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Durasi</p>
                                <p class="text-lg font-medium text-gray-800">{{ $booking->total_hours }} jam</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Biaya</p>
                                <p class="text-2xl font-bold text-red-600">{{ $booking->formatted_total_price }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Purpose -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">Tujuan Penggunaan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700">{{ $booking->purpose }}</p>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Pemesan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="font-medium text-gray-800">{{ $booking->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-800">{{ $booking->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Telepon</p>
                            <p class="font-medium text-gray-800">{{ $booking->user->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-medium text-gray-800">{{ $booking->user->address }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Notes -->
                @if($booking->admin_notes)
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Catatan Admin</h3>
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                            <div class="flex">
                                <i class="fas fa-info-circle text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <p class="font-medium text-yellow-800">Pesan untuk Anda:</p>
                                    <p class="text-yellow-700 mt-1">{{ $booking->admin_notes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Timeline -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-calendar-plus text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Booking Dibuat</p>
                                <p class="text-sm text-gray-500">{{ $booking->created_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($booking->approved_at)
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Disetujui</p>
                                    <p class="text-sm text-gray-500">{{ $booking->approved_at->format('d F Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($booking->rejected_at)
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-times text-red-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ditolak</p>
                                    <p class="text-sm text-gray-500">{{ $booking->rejected_at->format('d F Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            @if(Auth::user()->is_admin)
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Admin Actions</p>
                        </div>
                        <div class="flex space-x-3">
                            <button onclick="showModal('{{ $booking->id }}', '{{ $booking->status }}', `{{ $booking->admin_notes ?? '' }}`)" 
                                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium">
                                <i class="fas fa-edit mr-2"></i> Ubah Status
                            </button>
                            <a href="{{ route('admin.bookings') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 font-medium">
                                Kembali ke List
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Room Preview -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Preview Ruangan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="h-64 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-building text-red-400 text-6xl"></i>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $booking->room->name }}</h4>
                    <p class="text-gray-600 mb-4">{{ $booking->room->description }}</p>
                    
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-users text-red-500 mr-2"></i>
                            <span>Kapasitas: {{ $booking->room->capacity }} orang</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-wifi text-red-500 mr-2"></i>
                            <span>Fasilitas: {{ $booking->room->facilities }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-money-bill text-red-500 mr-2"></i>
                            <span>Harga: Rp {{ number_format($booking->room->price_per_hour, 0, ',', '.') }}/jam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Ubah Status Booking</h3>
            
            <form id="statusForm" method="POST">
                @csrf
                <input type="hidden" id="modal_booking_id" name="booking_id">
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Status Baru</label>
                    <select id="modal_status" name="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea id="modal_notes" name="admin_notes" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                              placeholder="Berikan catatan untuk pemesan..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function showModal(bookingId, currentStatus, notes) {
    const modal = document.getElementById('statusModal');
    const form = document.getElementById('statusForm');
    const statusSelect = document.getElementById('modal_status');
    const notesTextarea = document.getElementById('modal_notes');
    
    // Set current values
    document.getElementById('modal_booking_id').value = bookingId;
    statusSelect.value = currentStatus;
    notesTextarea.value = notes;
    
    // Set form action
    form.action = `/admin/bookings/${bookingId}/status`;
    
    // Show modal
    modal.classList.remove('hidden');
}

function hideModal() {
    document.getElementById('statusModal').classList.add('hidden');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('statusModal');
    if (event.target == modal) {
        hideModal();
    }
}
</script>
@endsection