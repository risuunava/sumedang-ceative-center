@extends('errors.layout')

@section('title', '503 - Dalam Perawatan')

@section('content')
<div class="error-card rounded-xl p-8">
    <!-- Error Icon -->
    <div class="flex justify-center mb-6">
        <div class="w-20 h-20 gradient-red rounded-full flex items-center justify-center">
            <i class="fas fa-tools text-white text-2xl"></i>
        </div>
    </div>
    
    <!-- Error Header -->
    <div class="text-center mb-6">
        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full mb-3">
            503 MAINTENANCE
        </span>
        <h1 class="text-2xl font-bold text-gray-900">Dalam Perawatan</h1>
        <p class="text-gray-600 mt-2">
            Sistem sedang dalam pemeliharaan.
        </p>
    </div>
    
    <!-- Maintenance Info -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-clock text-yellow-600 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-yellow-800 text-sm mb-1">Informasi Perawatan</h4>
                <p class="text-yellow-700 text-sm">
                    Kami sedang melakukan perbaikan untuk pengalaman yang lebih baik.
                    Sistem akan kembali dalam waktu singkat.
                </p>
                <div class="mt-2 flex items-center text-yellow-600 text-xs">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Perkiraan selesai: {{ now()->addMinutes(30)->format('H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action Button -->
    <button onclick="window.location.reload()" 
            class="block w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium text-center transition-colors">
        <i class="fas fa-redo mr-2"></i>Coba Lagi Nanti
    </button>
</div>
@endsection