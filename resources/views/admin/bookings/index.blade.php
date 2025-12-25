@extends('layouts.app')

@section('title', 'Kelola Booking - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Booking</h1>
                <p class="text-gray-600">Manajemen semua booking ruangan</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.export.bookings') . '?' . http_build_query(request()->query()) }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 font-medium shadow-md hover:shadow-lg transition-shadow duration-300 flex items-center">
                    <i class="fas fa-file-csv mr-2"></i> Export CSV
                </a>
                <a href="{{ route('admin.dashboard') }}" 
                   class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-medium shadow-sm hover:shadow transition-shadow duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-gray-700 mb-2 text-sm font-medium">Status</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2 text-sm font-medium">Ruangan</label>
                <select name="room_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                    <option value="">Semua Ruangan</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2 text-sm font-medium">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
            </div>
            
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-medium text-sm flex items-center justify-center">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.bookings') }}" class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium text-sm flex items-center justify-center">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
        
        <!-- Active Filters Badges -->
        @if(request()->has('status') || request()->has('room_id') || request()->has('date'))
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-600 mb-2">Filter aktif:</p>
                <div class="flex flex-wrap gap-2">
                    @if(request('status') && request('status') != 'all')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Status: {{ ucfirst(request('status')) }}
                            <a href="{{ route('admin.bookings', array_merge(request()->except('status'), ['status' => 'all'])) }}" class="ml-2 text-red-600 hover:text-red-800">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    
                    @if(request('room_id'))
                        @php $room = $rooms->firstWhere('id', request('room_id')); @endphp
                        @if($room)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Ruangan: {{ $room->name }}
                                <a href="{{ route('admin.bookings', request()->except('room_id')) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                    @endif
                    
                    @if(request('date'))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Tanggal: {{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }}
                            <a href="{{ route('admin.bookings', request()->except('date')) }}" class="ml-2 text-green-600 hover:text-green-800">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        @php
            $stats = [
                'total' => $bookings->total(),
                'pending' => $bookings->where('status', 'pending')->count(),
                'approved' => $bookings->where('status', 'approved')->count(),
                'completed' => $bookings->where('status', 'completed')->count(),
            ];
        @endphp
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-calendar text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Booking</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Approved</p>
                    <p class="text-xl font-bold text-green-600">{{ $stats['approved'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-check-double text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Completed</p>
                    <p class="text-xl font-bold text-blue-600">{{ $stats['completed'] }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bookings Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Daftar Booking</h2>
                    <p class="text-sm text-gray-600">{{ $bookings->total() }} booking ditemukan</p>
                </div>
                <div class="text-sm text-gray-500">
                    Halaman {{ $bookings->currentPage() }} dari {{ $bookings->lastPage() }}
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemesan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->booking_code }}</div>
                                <div class="text-xs text-gray-500">{{ $booking->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $booking->room->name }}</div>
                                <div class="text-xs text-gray-500">Kapasitas: {{ $booking->room->capacity }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $booking->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                <div class="text-xs text-gray-500">{{ $booking->user->phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $booking->booking_date->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $booking->start_time }} - {{ $booking->end_time }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $booking->total_hours }} jam</div>
                                <div class="text-xs text-gray-500">
                                    <!-- HAPUS REFERENSI KE HARGA PER JAM -->
                                    Durasi booking
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ 
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
                                
                                @if($booking->admin_notes)
                                    <div class="mt-1 text-xs text-gray-500 truncate max-w-xs" title="{{ $booking->admin_notes }}">
                                        <i class="fas fa-sticky-note mr-1"></i> {{ Str::limit($booking->admin_notes, 30) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="showModal({{ $booking->id }}, '{{ $booking->status }}', `{{ $booking->admin_notes ?? '' }}`)" 
                                            class="text-red-600 hover:text-red-900 p-1 hover:bg-red-50 rounded" title="Ubah Status">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="{{ route('booking.show', $booking) }}" class="text-blue-600 hover:text-blue-900 p-1 hover:bg-blue-50 rounded" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-calendar-times text-gray-300 text-5xl mb-3"></i>
                                    <p class="text-gray-500 font-medium text-lg mb-2">Tidak ada booking ditemukan</p>
                                    <p class="text-gray-400 text-sm">Coba gunakan filter yang berbeda</p>
                                    <a href="{{ route('admin.bookings') }}" class="mt-4 text-red-600 hover:text-red-700 font-medium">
                                        <i class="fas fa-redo mr-1"></i> Reset Filter
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
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

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-xl bg-white transform transition-all duration-300">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Ubah Status Booking</h3>
                <button onclick="hideModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="statusForm" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" id="modal_booking_id" name="booking_id">
                
                <div>
                    <label class="block text-gray-700 mb-2 text-sm font-medium">Status Baru</label>
                    <select id="modal_status" name="status" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2 text-sm font-medium">Catatan (Opsional)</label>
                    <textarea id="modal_notes" name="admin_notes" rows="3"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                              placeholder="Berikan catatan untuk pemesan..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Catatan akan dikirim ke pemesan</p>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="hideModal()"
                            class="px-4 py-2.5 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 font-medium text-sm transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium text-sm transition-colors duration-200 shadow-md hover:shadow-lg">
                        Simpan Perubahan
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
    
    // Set form action - SESUAI ROUTE BARU
    form.action = `/admin/bookings/${bookingId}/status`;
    
    // Show modal
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

function hideModal() {
    const modal = document.getElementById('statusModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('statusModal');
    if (event.target == modal) {
        hideModal();
    }
}

// Handle form submission
document.getElementById('statusForm').addEventListener('submit', function(e) {
    const status = document.getElementById('modal_status').value;
    const bookingId = document.getElementById('modal_booking_id').value;
    
    if (status === 'rejected') {
        const notes = document.getElementById('modal_notes').value;
        if (!notes.trim()) {
            e.preventDefault();
            alert('Harap berikan catatan untuk penolakan booking.');
            return;
        }
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
    submitBtn.disabled = true;
    
    // Restore button after form submission
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 3000);
});
</script>
@endsection