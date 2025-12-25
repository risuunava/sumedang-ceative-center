@extends('errors.layout')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="error-card rounded-xl p-8">
    <!-- Error Icon -->
    <div class="flex justify-center mb-6">
        <div class="w-20 h-20 gradient-red rounded-full flex items-center justify-center">
            <i class="fas fa-search text-white text-2xl"></i>
        </div>
    </div>
    
    <!-- Error Header -->
    <div class="text-center mb-6">
        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full mb-3">
            404 NOT FOUND
        </span>
        <h1 class="text-2xl font-bold text-gray-900">Halaman Tidak Ditemukan</h1>
        <p class="text-gray-600 mt-2">
            Halaman yang Anda cari tidak dapat ditemukan.
        </p>
    </div>
    
    <!-- Error Message -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-red-500 mt-1 mr-3"></i>
            <div>
                <p class="text-gray-700 text-sm">
                    URL mungkin salah atau halaman telah dipindahkan.
                    Periksa kembali alamat yang Anda masukkan.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Quick Links -->
    <div class="mb-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">Halaman Populer:</h3>
        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('home') }}" class="text-sm text-red-600 hover:text-red-700 hover:bg-red-50 p-2 rounded">
                <i class="fas fa-home mr-2"></i>Beranda
            </a>
            <a href="{{ route('sop') }}" class="text-sm text-red-600 hover:text-red-700 hover:bg-red-50 p-2 rounded">
                <i class="fas fa-file-alt mr-2"></i>SOP
            </a>
            @auth
            <a href="{{ route('booking.index') }}" class="text-sm text-red-600 hover:text-red-700 hover:bg-red-50 p-2 rounded">
                <i class="fas fa-calendar-check mr-2"></i>Bookings
            </a>
            <a href="{{ route('profile.index') }}" class="text-sm text-red-600 hover:text-red-700 hover:bg-red-50 p-2 rounded">
                <i class="fas fa-user mr-2"></i>Profile
            </a>
            @endif
        </div>
    </div>
    
    <!-- Action Button -->
    <a href="{{ route('home') }}" 
       class="block w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium text-center transition-colors">
        <i class="fas fa-home mr-2"></i>Kembali ke Beranda
    </a>
</div>
@endsection