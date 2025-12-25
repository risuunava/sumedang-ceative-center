@extends('errors.layout')

@section('title', '419 - Sesi Habis')

@section('content')
<div class="error-card rounded-xl p-8">
    <!-- Error Icon -->
    <div class="flex justify-center mb-6">
        <div class="w-20 h-20 gradient-red rounded-full flex items-center justify-center">
            <i class="fas fa-clock text-white text-2xl"></i>
        </div>
    </div>
    
    <!-- Error Header -->
    <div class="text-center mb-6">
        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full mb-3">
            419 SESSION EXPIRED
        </span>
        <h1 class="text-2xl font-bold text-gray-900">Sesi Telah Habis</h1>
        <p class="text-gray-600 mt-2">
            Sesi login Anda telah berakhir.
        </p>
    </div>
    
    <!-- Error Message -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-shield-alt text-red-500 mt-1 mr-3"></i>
            <div>
                <p class="text-gray-700 text-sm">
                    Untuk keamanan akun Anda, sesi login telah berakhir karena tidak ada aktivitas dalam beberapa waktu.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="space-y-3">
        <a href="{{ route('login') }}" 
           class="block w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium text-center transition-colors">
            <i class="fas fa-sign-in-alt mr-2"></i>Login Kembali
        </a>
        
        <a href="{{ route('home') }}" 
           class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-medium text-center transition-colors">
            <i class="fas fa-home mr-2"></i>Kembali ke Beranda
        </a>
    </div>
</div>
@endsection