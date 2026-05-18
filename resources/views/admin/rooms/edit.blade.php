@extends('layouts.app')

@section('title', 'Edit Ruangan - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Ruangan</h1>
                <p class="text-gray-600">Ubah informasi ruangan {{ $room->name }}</p>
            </div>
            <a href="{{ route('admin.rooms') }}" 
               class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
    
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif
    
    <!-- Edit Form -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Form Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-building text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Form Edit Ruangan</h2>
                        <p class="text-sm text-gray-600">Lengkapi data ruangan dengan benar</p>
                    </div>
                </div>
            </div>
            
            <!-- Form Content -->
            <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Room Name -->
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Nama Ruangan *</label>
                        <input type="text" name="name" value="{{ old('name', $room->name) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Contoh: Ruang Auditorium" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Capacity -->
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Kapasitas *</label>
                        <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="Contoh: 50" min="1" required>
                        @error('capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Status</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="is_active" value="1" 
                                       {{ old('is_active', $room->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <span class="ml-2 text-gray-700">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="is_active" value="0"
                                       {{ !old('is_active', $room->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <span class="ml-2 text-gray-700">Non-Aktif</span>
                            </label>
                        </div>
                        @error('is_active')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2 font-medium">Gambar Saat Ini</label>
                        @if($room->image_url && $room->image_url != asset('images/rooms/default.jpg'))
                            <div class="flex items-center space-x-4">
                                <img src="{{ $room->image_url }}" 
                                     alt="{{ $room->name }}" 
                                     class="w-32 h-32 object-cover rounded-lg shadow-md">
                                <div class="text-sm text-gray-600">
                                    <p>File: {{ basename($room->image) }}</p>
                                    <p>Path: {{ $room->image }}</p>
                                    <p class="mt-2">
                                        <input type="checkbox" id="remove_image" name="remove_image" value="1">
                                        <label for="remove_image" class="ml-2 text-red-600">Hapus gambar ini</label>
                                    </p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada gambar</p>
                        @endif
                    </div>

                    <!-- New Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2 font-medium">Upload Gambar Baru (Opsional)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-400 transition-colors duration-200">
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(event)">
                            <label for="image" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                                <p class="text-gray-600 font-medium mb-1">Klik untuk upload gambar baru</p>
                                <p class="text-gray-500 text-sm">Ukuran maksimal: 2MB, Format: JPG, PNG, JPEG, WebP</p>
                            </label>
                        </div>
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-4 hidden">
                            <img id="preview" class="max-w-xs rounded-lg shadow-md">
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2 font-medium">Deskripsi *</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Deskripsi lengkap tentang ruangan..." required>{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Facilities -->
                <div class="mb-8">
                    <label class="block text-gray-700 mb-2 font-medium">Fasilitas *</label>
                    <textarea name="facilities" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Masukkan fasilitas yang tersedia, dipisahkan dengan koma (Contoh: AC, Proyektor, WiFi, Sound System)"
                              required>{{ old('facilities', $room->facilities) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Pisahkan setiap fasilitas dengan koma (,)</p>
                    @error('facilities')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-between items-center space-x-4 pt-6 border-t border-gray-200">
                    <div>
                        <button type="button" 
                                onclick="confirmDelete()"
                                class="px-6 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium">
                            <i class="fas fa-trash mr-2"></i> Hapus Ruangan
                        </button>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.rooms') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium">
                            <i class="fas fa-times mr-2"></i> Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium shadow-md hover:shadow-lg">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Room Statistics -->
        <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Ruangan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <p class="text-sm text-gray-500">Total Booking</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $room->bookings()->count() }}</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-gray-500">Disetujui</p>
                    <p class="text-2xl font-bold text-green-600">{{ $room->bookings()->where('status', 'approved')->count() }}</p>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $room->bookings()->where('status', 'pending')->count() }}</p>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-gray-500">Selesai</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $room->bookings()->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Form -->
<form id="deleteForm" method="POST" action="{{ route('admin.rooms.destroy', $room) }}" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.classList.add('hidden');
    }
}

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus ruangan ini? Semua booking terkait juga akan dihapus.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection