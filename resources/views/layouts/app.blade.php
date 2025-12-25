<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sumedang Creative Center - Sistem booking ruangan kreatif premium untuk masyarakat Sumedang">
    <title>@yield('title', 'Sumedang Creative Center | Booking Ruangan Premium')</title>
    
    <!-- Premium Styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-red: #DC2626;
            --primary-red-dark: #991B1B;
            --primary-red-light: #FEE2E2;
            --gradient-red: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        }
        
        * {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        
        .gradient-red {
            background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        }
        
        .text-gradient-red {
            background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #B91C1C 0%, #7F1D1D 100%);
        }
        
        /* Smooth transitions */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Navigation link styles */
        .nav-link {
            @apply text-gray-600 hover:text-red-700 transition-all duration-300 relative;
        }
        
        .nav-link.active {
            @apply text-red-700 font-semibold;
        }
        
        .nav-underline {
            @apply absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-red-500 to-red-400 transition-all duration-500 rounded-full;
        }
        
        .nav-link:hover .nav-underline,
        .nav-link.active .nav-underline {
            @apply w-3/4;
        }
        
        /* Mobile navigation link */
        .mobile-nav-link {
            @apply flex items-center px-4 py-3 text-gray-700 hover:text-red-600 hover:bg-gradient-to-r from-red-50/30 to-transparent rounded-xl transition-all duration-200;
        }
        
        .mobile-nav-link.active {
            @apply text-red-600 bg-gradient-to-r from-red-50 to-red-50/50 font-semibold;
        }
        
        /* Animations */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-15px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes gradient-y {
            0%, 100% { transform: translateY(-100%); }
            50% { transform: translateY(100%); }
        }
        
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .animate-slide-down {
            animation: slide-down 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .animate-gradient-y {
            animation: gradient-y 3s ease-in-out infinite;
        }
        
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
        
        /* Hamburger animation */
        .hamburger-active #mobile-bar1 {
            transform: translateY(6px) rotate(45deg);
        }
        
        .hamburger-active #mobile-bar2 {
            opacity: 0;
        }
        
        .hamburger-active #mobile-bar3 {
            transform: translateY(-6px) rotate(-45deg);
        }
        
        /* Rotate animation */
        .rotate-180 {
            transform: rotate(180deg);
        }

        /* MOBILE MENU IMPROVED */
        .mobile-menu-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 49;
            animation: fade-in 0.2s ease-out;
        }
        
        .mobile-menu-container {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 300px;
            background: white;
            z-index: 50;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.15);
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .mobile-menu-container.open {
            transform: translateX(0);
        }
        
        .mobile-menu-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(to right, #fef2f2, #fff);
        }
        
        .mobile-menu-content {
            height: calc(100vh - 180px);
            overflow-y: auto;
            padding: 16px;
        }
        
        .mobile-menu-section {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
            margin-top: 20px;
            padding-left: 8px;
        }
        
        .mobile-menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 4px;
            color: #374151;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .mobile-menu-item:hover {
            background: linear-gradient(to right, #fef2f2, #fef2f2);
            color: #dc2626;
        }
        
        .mobile-menu-item.active {
            background: linear-gradient(to right, #fef2f2, #fee2e2);
            color: #dc2626;
            font-weight: 600;
        }
        
        .mobile-user-card {
            background: linear-gradient(to right, #f9fafb, #f3f4f6);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
        }
        
        .mobile-user-name {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }
        
        .mobile-user-email {
            font-size: 12px;
            color: #6b7280;
        }
        
        .mobile-info-box {
            background: #f9fafb;
            border-radius: 10px;
            padding: 12px;
            margin-top: 20px;
            border: 1px solid #e5e7eb;
        }
        
        .mobile-info-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }
        
        .mobile-info-value {
            font-size: 12px;
            color: #6b7280;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-gray-50 antialiased">
    <!-- Premium Navigation -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <!-- Premium Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="w-12 h-12 gradient-red rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-500 overflow-hidden ring-2 ring-white/50">
                            <!-- Logo Image -->
                            <img src="{{ asset('storage/logoscc.jpeg') }}" 
                                 alt="Sumedang Creative Center Logo"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fas fa-sparkles text-white text-lg\'></i>';">
                        </div>
                        <div class="absolute -inset-2 bg-gradient-to-r from-red-400 via-red-500 to-red-600 rounded-xl blur-lg opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                    </div>
                    <div class="relative overflow-hidden">
                        <div class="text-xl font-black text-gray-900 tracking-tight transform group-hover:translate-x-1 transition-transform duration-300">SUMEDANG</div>
                        <div class="text-xs font-bold text-gradient-red tracking-wider uppercase bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-red-600">Creative Center</div>
                        <div class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-red-400 group-hover:w-full transition-all duration-500"></div>
                    </div>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-3">
                    <!-- Navigation Links dengan Glassmorphism -->
                    <div class="flex items-center space-x-1 bg-white/50 backdrop-blur-sm rounded-2xl p-1.5 shadow-inner ring-1 ring-gray-200/50">
                        <a href="{{ route('home') }}" 
                           class="nav-link group px-5 py-2.5 rounded-xl relative overflow-hidden {{ request()->routeIs('home') ? 'active bg-gradient-to-br from-white to-gray-50 shadow-md ring-1 ring-gray-200/50' : '' }}">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/5 to-red-500/0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            <i class="fas fa-house mr-2.5 text-sm relative z-10 {{ request()->routeIs('home') ? 'text-red-600' : 'text-gray-500' }}"></i>
                            <span class="font-medium relative z-10">Home</span>
                            <div class="nav-underline"></div>
                        </a>
                        
                        <a href="{{ route('sop') }}" 
                           class="nav-link group px-5 py-2.5 rounded-xl relative overflow-hidden {{ request()->routeIs('sop') ? 'active bg-gradient-to-br from-white to-gray-50 shadow-md ring-1 ring-gray-200/50' : '' }}">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/5 to-red-500/0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            <i class="fas fa-book-open mr-2.5 text-sm relative z-10 {{ request()->routeIs('sop') ? 'text-red-600' : 'text-gray-500' }}"></i>
                            <span class="font-medium relative z-10">SOP</span>
                            <div class="nav-underline"></div>
                        </a>
                        
                        @auth
                            <a href="{{ route('booking.index') }}" 
                               class="nav-link group px-5 py-2.5 rounded-xl relative overflow-hidden {{ request()->routeIs('booking.*') ? 'active bg-gradient-to-br from-white to-gray-50 shadow-md ring-1 ring-gray-200/50' : '' }}">
                                <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/5 to-red-500/0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                <i class="fas fa-calendar-day mr-2.5 text-sm relative z-10 {{ request()->routeIs('booking.*') ? 'text-red-600' : 'text-gray-500' }}"></i>
                                <span class="font-medium relative z-10">Bookings</span>
                                <div class="nav-underline"></div>
                            </a>
                            
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="nav-link group px-5 py-2.5 rounded-xl relative overflow-hidden {{ request()->is('admin*') ? 'active bg-gradient-to-br from-white to-gray-50 shadow-md ring-1 ring-gray-200/50' : '' }}">
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/5 to-red-500/0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                    <i class="fas fa-shield mr-2.5 text-sm relative z-10 {{ request()->is('admin*') ? 'text-red-600' : 'text-gray-500' }}"></i>
                                    <span class="font-medium relative z-10">Admin</span>
                                    <div class="nav-underline"></div>
                                </a>
                            @endif
                        @endauth
                    </div>
                    
                    <!-- Animated Separator -->
                    <div class="relative h-8 w-px mx-2 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-300 to-transparent animate-gradient-y"></div>
                    </div>
                    
                    @auth
                        <!-- User Dropdown dengan Animasi Elegant -->
                        <div class="relative" id="user-dropdown">
                            <button class="flex items-center space-x-3 px-4 py-2.5 rounded-xl bg-gradient-to-br from-gray-50 to-white hover:from-gray-100 hover:to-white shadow-sm hover:shadow-md ring-1 ring-gray-200/50 hover:ring-red-200/50 transition-all duration-300 group"
                                    onclick="toggleDropdown()">
                                <div class="relative">
                                    <div class="w-9 h-9 gradient-red rounded-full flex items-center justify-center shadow-sm group-hover:shadow relative overflow-hidden">
                                        <span class="text-white font-bold text-sm relative z-10">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                        <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="absolute -inset-1 bg-gradient-to-r from-red-400 to-red-600 rounded-full blur opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                                </div>
                                <div class="text-left">
                                    <div class="text-sm font-semibold text-gray-900 truncate max-w-[120px]">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-500 truncate max-w-[120px]">{{ auth()->user()->email }}</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs transition-all duration-300 group-hover:text-red-500 group-hover:rotate-180" id="dropdown-arrow"></i>
                            </button>
                            
                            <!-- Dropdown Menu dengan Glass Effect -->
                            <div class="absolute right-0 mt-3 w-64 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200/50 hidden animate-fade-in-up z-50 overflow-hidden"
                                 id="dropdown-menu">
                                <div class="p-5 border-b border-gray-200/50 bg-gradient-to-r from-gray-50/50 to-white/50">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative">
                                            <div class="w-12 h-12 gradient-red rounded-full flex items-center justify-center shadow-lg">
                                                <span class="text-white font-bold text-base">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                            </div>
                                            <div class="absolute -inset-2 bg-gradient-to-r from-red-400 to-red-600 rounded-full blur opacity-20"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</div>
                                            <div class="text-xs text-gray-500 truncate mt-1 flex items-center">
                                                <i class="fas fa-envelope mr-1.5 text-xs"></i>
                                                {{ auth()->user()->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-2">
                                    <a href="{{ route('profile.index') }}" class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:text-red-600 hover:bg-gradient-to-r from-red-50/50 to-transparent rounded-xl transition-all duration-200 mb-1">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center mr-3 group-hover:from-red-200 group-hover:to-red-100 transition-all duration-300">
                                            <i class="fas fa-user-circle text-red-500 text-base group-hover:scale-110 transition-transform duration-300"></i>
                                        </div>
                                        <span class="font-medium">My Profile</span>
                                        <i class="fas fa-arrow-right ml-auto text-gray-300 group-hover:text-red-400 group-hover:translate-x-1 transition-all duration-300"></i>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" 
                                                class="group w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:text-red-600 hover:bg-gradient-to-r from-red-50/50 to-transparent rounded-xl transition-all duration-200 mt-1">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mr-3 group-hover:from-red-100 group-hover:to-red-50 transition-all duration-300">
                                                <i class="fas fa-arrow-right-from-bracket text-gray-500 text-base group-hover:text-red-500 group-hover:scale-110 transition-all duration-300"></i>
                                            </div>
                                            <span class="font-medium">Sign Out</span>
                                            <i class="fas fa-sign-out ml-auto text-gray-300 group-hover:text-red-400 group-hover:translate-x-1 transition-all duration-300"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Auth Buttons dengan Animasi Spesial -->
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" 
                               class="group relative px-6 py-2.5 rounded-xl font-medium overflow-hidden transition-all duration-300 hover:shadow-md">
                                <div class="absolute inset-0 bg-gradient-to-r from-gray-50 to-white ring-1 ring-gray-200/50 rounded-xl"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-red-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                                <div class="relative flex items-center text-gray-700 group-hover:text-red-600 transition-colors duration-300">
                                    <i class="fas fa-arrow-right-to-bracket mr-2.5 group-hover:rotate-12 transition-transform duration-300"></i>
                                    <span>Sign In</span>
                                </div>
                            </a>
                            
                            <a href="{{ route('register') }}" 
                               class="group relative px-7 py-2.5 rounded-xl font-semibold overflow-hidden transition-all duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-red-500 via-red-600 to-red-500 rounded-xl"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-700 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                                <div class="absolute -inset-1 bg-gradient-to-r from-red-400 via-red-500 to-red-400 blur-lg opacity-0 group-hover:opacity-30 transition-opacity duration-500 rounded-xl"></div>
                                <div class="relative flex items-center text-white">
                                    <i class="fas fa-rocket mr-2.5 group-hover:animate-bounce"></i>
                                    <span>Get Started</span>
                                    <i class="fas fa-sparkles ml-2 opacity-0 group-hover:opacity-100 group-hover:animate-pulse transition-opacity duration-300"></i>
                                </div>
                            </a>
                        </div>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="lg:hidden relative w-10 h-10 flex items-center justify-center"
                        onclick="toggleMobileMenu()">
                    <div class="w-6 h-6 flex flex-col items-center justify-center relative">
                        <span class="w-6 h-0.5 bg-gray-700 rounded-full transition-all duration-300"
                              id="mobile-bar1"></span>
                        <span class="w-6 h-0.5 bg-gray-700 rounded-full transition-all duration-300 mt-1.5"
                              id="mobile-bar2"></span>
                        <span class="w-6 h-0.5 bg-gray-700 rounded-full transition-all duration-300 mt-1.5"
                              id="mobile-bar3"></span>
                    </div>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay (DITAMBAHKAN) -->
    <div id="mobile-menu-backdrop" class="mobile-menu-backdrop hidden"></div>
    
    <!-- Mobile Menu Container (DITAMBAHKAN) -->
    <div id="mobile-menu-container" class="mobile-menu-container">
        <!-- Header -->
        <div class="mobile-menu-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 gradient-red rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">SC</span>
                    </div>
                    <div>
                        <div class="text-lg font-black text-gray-900">SUMEDANG</div>
                        <div class="text-xs text-red-600 font-semibold uppercase">Creative Center</div>
                    </div>
                </div>
                <button onclick="toggleMobileMenu()" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-times text-gray-600"></i>
                </button>
            </div>
            
            @auth
            <div class="mobile-user-card mt-4">
                <div class="mobile-user-name">{{ auth()->user()->name }}</div>
                <div class="mobile-user-email">{{ auth()->user()->email }}</div>
            </div>
            @endauth
        </div>
        
        <!-- Content -->
        <div class="mobile-menu-content">
            <!-- Navigation -->
            <div class="mobile-menu-section">Navigation</div>
            <div class="space-y-1">
                <a href="{{ route('home') }}" 
                   class="mobile-menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home mr-3 text-gray-400"></i>
                    Home
                </a>
                
                @auth
                <a href="{{ route('booking.index') }}" 
                   class="mobile-menu-item {{ request()->routeIs('booking.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt mr-3 text-gray-400"></i>
                    Bookings
                </a>
                @endif
                
                <a href="{{ route('sop') }}" 
                   class="mobile-menu-item {{ request()->routeIs('sop') ? 'active' : '' }}">
                    <i class="fas fa-book mr-3 text-gray-400"></i>
                    SOP
                </a>
                
                @auth
                    @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" 
                       class="mobile-menu-item {{ request()->is('admin*') ? 'active' : '' }}">
                        <i class="fas fa-shield-alt mr-3 text-gray-400"></i>
                        Admin
                    </a>
                    @endif
                @endauth
            </div>
            
            <!-- Account -->
            <div class="mobile-menu-section">Account</div>
            @auth
            <div class="space-y-1">
                <a href="{{ route('profile.index') }}" 
                   class="mobile-menu-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                    My Profile
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-menu-item w-full text-left">
                        <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                        Sign Out
                    </button>
                </form>
            </div>
            @else
            <div class="space-y-2">
                <a href="{{ route('login') }}" 
                   class="mobile-menu-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <i class="fas fa-sign-in-alt mr-3 text-gray-400"></i>
                    Sign In
                </a>
                
                <a href="{{ route('register') }}" 
                   class="block w-full bg-gradient-to-r from-red-500 to-red-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-sm">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create Account
                </a>
            </div>
            @endauth
            
            <!-- Info -->
            <div class="mobile-info-box">
                <div class="mb-3">
                    <div class="mobile-info-label">Jam Operasional</div>
                    <div class="mobile-info-value">08:00 - 21:00 (Setiap Hari)</div>
                </div>
                <div>
                    <div class="mobile-info-label">Kontak</div>
                    <div class="mobile-info-value">(022) 1234-5678</div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100 bg-white">
            <div class="text-center text-xs text-gray-500">
                © {{ date('Y') }} Sumedang Creative Center
            </div>
        </div>
    </div>

    <!-- Premium Flash Messages -->
    <div class="container mx-auto px-4 lg:px-8 mt-6">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-emerald-500 rounded-r-xl p-4 mb-4 shadow-sm animate-fade-in">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-600"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-emerald-900">Success</h3>
                        <p class="text-emerald-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-r-xl p-4 mb-4 shadow-sm animate-fade-in">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-red-900">Error</h3>
                        <p class="text-red-700 mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-r-xl p-4 mb-4 shadow-sm animate-fade-in">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-red-900">Validation Error</h3>
                        <div class="space-y-2 mt-2">
                            @foreach($errors->all() as $error)
                                <p class="text-red-700 flex items-center text-sm">
                                    <i class="fas fa-circle text-[6px] mr-2"></i>{{ $error }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-white mt-20 relative">
        <div class="container mx-auto px-4 lg:px-8 pt-16 pb-12 relative z-10">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">
                <!-- Brand Column di Footer -->
                <div class="lg:col-span-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-6 group">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl smooth-transition overflow-hidden border border-gray-200">
                            <!-- Logo Image -->
                            <div id="footer-logo-wrapper">
                                <img src="{{ asset('storage/logoscc.jpeg') }}" 
                                    alt="Sumedang Creative Center Logo"
                                    class="w-full h-full object-contain p-1.5"
                                    onerror="this.onerror=null; this.style.display='none'; document.getElementById('footer-logo-wrapper').innerHTML = '<div class=\'w-12 h-12 gradient-red rounded-xl flex items-center justify-center\'><i class=\'fas fa-sparkles text-white text-lg\'></i></div>';">
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-white tracking-tight">SUMEDANG</div>
                            <div class="text-sm font-bold text-gradient-red tracking-wider uppercase">Creative Center</div>
                        </div>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6 max-w-md">
                        Pusat inovasi digital dan ruang kreatif premium untuk mengembangkan potensi masyarakat Sumedang. 
                        Fasilitas canggih tanpa biaya untuk mendukung ekosistem kreator lokal.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-full flex items-center justify-center smooth-transition group">
                            <i class="fab fa-instagram text-gray-400 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-full flex items-center justify-center smooth-transition group">
                            <i class="fab fa-facebook-f text-gray-400 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-full flex items-center justify-center smooth-transition group">
                            <i class="fab fa-twitter text-gray-400 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-full flex items-center justify-center smooth-transition group">
                            <i class="fab fa-youtube text-gray-400 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="lg:col-span-2">
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-link mr-2 text-red-400"></i> Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white smooth-transition text-sm flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-red-400 opacity-0 group-hover:opacity-100 smooth-transition"></i>
                            Home
                        </a></li>
                        <li><a href="{{ route('sop') }}" class="text-gray-400 hover:text-white smooth-transition text-sm flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-red-400 opacity-0 group-hover:opacity-100 smooth-transition"></i>
                            SOP & Guidelines
                        </a></li>
                        @auth
                            <li><a href="{{ route('booking.index') }}" class="text-gray-400 hover:text-white smooth-transition text-sm flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-red-400 opacity-0 group-hover:opacity-100 smooth-transition"></i>
                                My Bookings
                            </a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white smooth-transition text-sm flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-red-400 opacity-0 group-hover:opacity-100 smooth-transition"></i>
                                Sign In
                            </a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white smooth-transition text-sm flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-red-400 opacity-0 group-hover:opacity-100 smooth-transition"></i>
                                Register
                            </a></li>
                        @endauth
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="lg:col-span-3">
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-address-card mr-2 text-red-400"></i> Contact Info
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-red-400"></i>
                            </div>
                            <div>
                                <div class="text-white text-sm font-medium">Our Location</div>
                                <div class="text-gray-400 text-sm mt-1">Jl. Cut Nyak Dien No. 2, Bunderan Binokasih</div>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <div class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-red-400"></i>
                            </div>
                            <div>
                                <div class="text-white text-sm font-medium">Phone Number</div>
                                <div class="text-gray-400 text-sm mt-1">(022) 1234-5678</div>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <div class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-red-400"></i>
                            </div>
                            <div>
                                <div class="text-white text-sm font-medium">Email Address</div>
                                <div class="text-gray-400 text-sm mt-1">info@scc-sumdang.id</div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Operating Hours -->
                <div class="lg:col-span-3">
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-clock mr-2 text-red-400"></i> Operating Hours
                    </h3>
                    <div class="bg-gray-800/50 rounded-xl p-5 border border-gray-700/50">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-700/50">
                                <span class="text-gray-400 text-sm">Senin - Minggu</span>
                                <span class="text-white font-medium">08:00 - 21:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright & Bottom Bar -->
            <div class="border-t border-gray-800 mt-10 pt-8">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="text-gray-500 text-sm">
                        &copy; {{ date('Y') }} Sumedang Creative Center By Nugaduh Stack. All rights reserved.
                    </div>
                    <div class="flex items-center space-x-6 text-sm">
                        <a href="#" class="text-gray-500 hover:text-white smooth-transition">Privacy Policy</a>
                        <a href="#" class="text-gray-500 hover:text-white smooth-transition">Terms of Service</a>
                        <a href="#" class="text-gray-500 hover:text-white smooth-transition">Cookie Policy</a>
                    </div>
                </div>
                
                <!-- Back to Top Button -->
                <div class="text-center mt-8">
                    <button onclick="scrollToTop()" 
                            class="inline-flex items-center text-gray-500 hover:text-white smooth-transition group">
                        <i class="fas fa-arrow-up mr-2 group-hover:-translate-y-1 smooth-transition"></i>
                        Back to Top
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        let mobileMenuOpen = false;
        
        function toggleMobileMenu() {
            const backdrop = document.getElementById('mobile-menu-backdrop');
            const container = document.getElementById('mobile-menu-container');
            const body = document.body;
            
            mobileMenuOpen = !mobileMenuOpen;
            
            if (mobileMenuOpen) {
                backdrop.classList.remove('hidden');
                container.classList.add('open');
                body.style.overflow = 'hidden';
                
                // Animate hamburger
                document.getElementById('mobile-bar1').style.transform = 'rotate(45deg) translate(5px, 5px)';
                document.getElementById('mobile-bar2').style.opacity = '0';
                document.getElementById('mobile-bar3').style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                backdrop.classList.add('hidden');
                container.classList.remove('open');
                body.style.overflow = '';
                
                // Reset hamburger
                document.getElementById('mobile-bar1').style.transform = '';
                document.getElementById('mobile-bar2').style.opacity = '';
                document.getElementById('mobile-bar3').style.transform = '';
            }
        }
        
        // Close mobile menu when clicking backdrop
        document.getElementById('mobile-menu-backdrop').addEventListener('click', toggleMobileMenu);
        
        // Close mobile menu with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenuOpen) {
                toggleMobileMenu();
            }
        });

        // Existing functions
        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const arrow = document.getElementById('dropdown-arrow');
            
            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            const menu = document.getElementById('dropdown-menu');
            
            if (dropdown && menu && !dropdown.contains(event.target)) {
                menu.classList.add('hidden');
                document.getElementById('dropdown-arrow').classList.remove('rotate-180');
            }
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 10) {
                nav.classList.add('shadow-xl', 'bg-white/80');
                nav.classList.remove('shadow-lg');
            } else {
                nav.classList.remove('shadow-xl', 'bg-white/80');
                nav.classList.add('shadow-lg');
            }
        });

        // Set min date for date inputs
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelectorAll('input[type="date"]').forEach(input => {
                if (!input.value) {
                    input.min = today;
                }
            });
        });

        // Back to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Add active class to current page links
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link, .mobile-menu-item').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>