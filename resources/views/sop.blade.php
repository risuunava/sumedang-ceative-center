@extends('layouts.app')

@section('title', 'SOP Peminjaman - Sumedang Creative Center')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Standar Operasional Prosedur (SOP) Peminjaman Ruangan</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Panduan lengkap untuk proses peminjaman ruangan di Sumedang Creative Center
        </p>
    </div>
    
    <!-- SOP List -->
    <div class="max-w-4xl mx-auto">
        @foreach($sops as $sop)
            <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
                <div class="bg-red-600 text-white p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white text-red-600 rounded-full flex items-center justify-center font-bold text-xl mr-4">
                            {{ $loop->iteration }}
                        </div>
                        <h2 class="text-2xl font-bold">{{ $sop->title }}</h2>
                    </div>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($sop->content)) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Important Notes -->
    <div class="max-w-4xl mx-auto mt-12">
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-yellow-800">Catatan Penting</h3>
                    <div class="mt-2 text-yellow-700">
                        <ul class="list-disc list-inside space-y-2">
                            <li>Booking yang sudah disetujui tidak dapat dibatalkan tanpa alasan yang jelas</li>
                            <li>Keterlambatan lebih dari 30 menit dapat mengakibatkan pembatalan booking</li>
                            <li>Kerusakan alat dan fasilitas menjadi tanggung jawab peminjam</li>
                            <li>Dilarang keras merokok di dalam semua ruangan</li>
                            <li>Harap menjaga kebersihan ruangan selama dan setelah penggunaan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Support -->
        <div class="bg-red-50 rounded-xl p-6 mt-8 text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Butuh Bantuan?</h3>
            <p class="text-gray-600 mb-6">Tim support kami siap membantu Anda dalam proses booking</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg">
                    <i class="fas fa-phone text-red-600 text-2xl mb-2"></i>
                    <p class="font-bold">Telepon</p>
                    <p class="text-gray-600">(022) 1234-5678</p>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <i class="fas fa-envelope text-red-600 text-2xl mb-2"></i>
                    <p class="font-bold">Email</p>
                    <p class="text-gray-600">booking@scc-sumdang.id</p>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <i class="fas fa-clock text-red-600 text-2xl mb-2"></i>
                    <p class="font-bold">Jam Layanan</p>
                    <p class="text-gray-600">08:00 - 17:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection