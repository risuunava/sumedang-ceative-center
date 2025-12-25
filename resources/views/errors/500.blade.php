@extends('errors.layout')

@section('title', '500 - Kesalahan Server')

@section('content')
<div class="error-card rounded-xl p-8">
    <!-- Error Icon -->
    <div class="flex justify-center mb-6">
        <div class="w-20 h-20 gradient-red rounded-full flex items-center justify-center">
            <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
        </div>
    </div>
    
    <!-- Error Header -->
    <div class="text-center mb-6">
        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full mb-3">
            500 SERVER ERROR
        </span>
        <h1 class="text-2xl font-bold text-gray-900">Kesalahan Server</h1>
        <p class="text-gray-600 mt-2">
            Terjadi kesalahan pada server kami.
        </p>
    </div>
    
    <!-- Error Message -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-server text-red-500 mt-1 mr-3"></i>
            <div>
                <p class="text-gray-700 text-sm mb-2">
                    Kami sedang mengalami masalah teknis. Tim kami telah diberitahu dan sedang berusaha memperbaikinya.
                </p>
                <p class="text-gray-600 text-xs">
                    Silakan coba lagi dalam beberapa menit.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="space-y-3">
        <button onclick="window.location.reload()" 
                class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-medium text-center transition-colors">
            <i class="fas fa-redo mr-2"></i>Refresh Halaman
        </button>
        
        <a href="mailto:support@sumedangcreative.com" 
           class="block w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium text-center transition-colors">
            <i class="fas fa-headset mr-2"></i>Hubungi Support
        </a>
    </div>
</div>
@endsection