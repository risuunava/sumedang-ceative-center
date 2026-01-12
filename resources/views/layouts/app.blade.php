<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sumedang Creative Center')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .bg-primary {
            background-color: #DC2626;
        }
        .text-primary {
            color: #DC2626;
        }
        .hover\:bg-primary-dark:hover {
            background-color: #B91C1C;
        }
        .border-primary {
            border-color: #DC2626;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-gray-800">SCC<span class="text-primary">Booking</span></span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('home') ? 'text-primary' : '' }}">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('sop') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('sop') ? 'text-primary' : '' }}">
                        <i class="fas fa-file-alt mr-2"></i>SOP
                    </a>
                    
                    @auth
                        <a href="{{ route('booking.index') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->routeIs('booking.*') ? 'text-primary' : '' }}">
                            <i class="fas fa-calendar-check mr-2"></i>Booking Saya
                        </a>
                        
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary font-medium {{ request()->is('admin*') ? 'text-primary' : '' }}">
                                <i class="fas fa-cog mr-2"></i>Admin
                            </a>
                        @endif
                        
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-primary">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary font-medium">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium">
                                <i class="fas fa-user-plus mr-2"></i>Daftar
                            </a>
                        </div>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-700" id="mobile-menu-button">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            
            <!-- Mobile menu -->
            <div class="md:hidden hidden py-4 border-t" id="mobile-menu">
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary font-medium">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('sop') }}" class="text-gray-700 hover:text-primary font-medium">
                        <i class="fas fa-file-alt mr-2"></i>SOP
                    </a>
                    
                    @auth
                        <a href="{{ route('booking.index') }}" class="text-gray-700 hover:text-primary font-medium">
                            <i class="fas fa-calendar-check mr-2"></i>Booking Saya
                        </a>
                        
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary font-medium">
                                <i class="fas fa-cog mr-2"></i>Admin
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-primary font-medium">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    @else
                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary font-medium">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium text-center">
                                <i class="fas fa-user-plus mr-2"></i>Daftar
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4" role="alert">
            <div class="flex">
                <div class="py-1"><i class="fas fa-check-circle mr-2"></i></div>
                <div>
                    <p class="font-bold">Berhasil</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4" role="alert">
            <div class="flex">
                <div class="py-1"><i class="fas fa-exclamation-circle mr-2"></i></div>
                <div>
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4" role="alert">
            <div class="flex">
                <div class="py-1"><i class="fas fa-exclamation-circle mr-2"></i></div>
                <div>
                    <p class="font-bold">Terdapat kesalahan</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">SCC<span class="text-primary">Booking</span></span>
                    </div>
                    <p class="text-gray-300">
                        Sistem booking ruangan terpadu untuk Sumedang Creative Center. 
                        Fasilitas kreatif untuk masyarakat Sumedang.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Jl. Kreatif No. 123, Sumedang</p>
                        <p><i class="fas fa-phone mr-2"></i> (022) 1234-5678</p>
                        <p><i class="fas fa-envelope mr-2"></i> info@scc-sumdang.id</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Jam Operasional</h3>
                    <div class="space-y-2 text-gray-300">
                        <p>Senin - Jumat: 08:00 - 22:00</p>
                        <p>Sabtu: 08:00 - 20:00</p>
                        <p>Minggu: 09:00 - 18:00</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Sumedang Creative Center. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Timezone handling
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const dateInputs = document.querySelectorAll('input[type="date"]');
            dateInputs.forEach(input => {
                if (!input.value) {
                    input.min = today;
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>