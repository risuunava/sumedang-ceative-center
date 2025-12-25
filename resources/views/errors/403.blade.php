@extends('errors.layout')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="error-card rounded-xl p-8">
    <!-- Error Icon -->
    <div class="flex justify-center mb-6">
        <div class="w-20 h-20 gradient-red rounded-full flex items-center justify-center">
            <i class="fas fa-ban text-white text-2xl"></i>
        </div>
    </div>
    
    <!-- Error Header -->
    <div class="text-center mb-6">
        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full mb-3">
            403 FORBIDDEN
        </span>
        <h1 class="text-2xl font-bold text-gray-900">Akses Ditolak</h1>
        <p class="text-gray-600 mt-2">
            Hanya admin yang dapat mengakses halaman ini.
        </p>
    </div>
    
    <!-- Error Message -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
            <div>
                <p class="text-gray-700 text-sm">
                    Anda tidak memiliki izin untuk mengakses halaman ini.
                    Silakan hubungi administrator jika Anda memerlukan akses.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="space-y-3">
        <a href="{{ url()->previous() }}" 
           class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-medium text-center transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        
        @auth
            <a href="{{ route('profile.index') }}" 
               class="block w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium text-center transition-colors">
                <i class="fas fa-user mr-2"></i>Ke Profil Saya
            </a>
        @else
            <a href="{{ route('login') }}" 
               class="block w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium text-center transition-colors">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </a>
        @endauth
    </div>
</div>
@endsection