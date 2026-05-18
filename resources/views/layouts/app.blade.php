<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sumedang Creative Center - Sistem booking ruangan kreatif premium untuk masyarakat Sumedang">
    <title>@yield('title', 'Sumedang Creative Center | Booking Ruangan Premium')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-red': '#e60000',
                        'brand-red-dark': '#ac1811',
                        'charcoal': '#25282b',
                        'body-grey': '#7e7e7e',
                        'form-grey': '#333333',
                        'light-neutral': '#f2f2f2',
                        'signal-blue': '#3860be',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif; -webkit-font-smoothing: antialiased; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f2f2f2; }
        ::-webkit-scrollbar-thumb { background: #e60000; border-radius: 4px; }

        /* Mobile Menu */
        .mobile-menu-backdrop { position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:49; }
        .mobile-menu-container { position:fixed; top:0; right:0; bottom:0; width:300px; background:#fff; z-index:50; transform:translateX(100%); transition:transform .3s ease; }
        .mobile-menu-container.open { transform:translateX(0); }

        /* Nav scroll */
        .nav-scrolled { background: rgba(255,255,255,0.97) !important; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }

        /* Animations */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.25s ease-out; }
    </style>
    
    @yield('styles')
</head>
<body class="bg-white antialiased text-charcoal">

    <!-- Navigation -->
    <nav id="main-nav" class="bg-white sticky top-0 z-50 border-b border-gray-100" style="height:64px;">
        <div class="max-w-[1440px] mx-auto px-8 h-full">
            <div class="flex justify-between items-center h-full">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-brand-red rounded-full flex items-center justify-center overflow-hidden flex-shrink-0">
                        <img src="{{ asset('storage/logoscc.jpeg') }}" alt="SCC Logo" class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<span class=\'text-white font-extrabold text-sm\'>SC</span>';">
                    </div>
                    <div>
                        <div class="text-lg font-extrabold text-charcoal tracking-tight leading-tight">SUMEDANG</div>
                        <div class="text-[11px] font-bold text-brand-red tracking-widest uppercase">Creative Center</div>
                    </div>
                </a>
                
                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-base font-normal {{ request()->routeIs('home') ? 'text-brand-red font-semibold' : 'text-charcoal hover:text-brand-red' }} transition-colors">Home</a>
                    <a href="{{ route('sop') }}" class="px-4 py-2 text-base font-normal {{ request()->routeIs('sop') ? 'text-brand-red font-semibold' : 'text-charcoal hover:text-brand-red' }} transition-colors">SOP</a>
                    
                    @auth
                        <a href="{{ route('booking.index') }}" class="px-4 py-2 text-base font-normal {{ request()->routeIs('booking.*') ? 'text-brand-red font-semibold' : 'text-charcoal hover:text-brand-red' }} transition-colors">Bookings</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.rooms') }}" class="px-4 py-2 text-base font-normal {{ request()->routeIs('admin.rooms') ? 'text-brand-red font-semibold' : 'text-charcoal hover:text-brand-red' }} transition-colors">Rooms</a>
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-base font-normal {{ request()->is('admin*') && !request()->routeIs('admin.rooms') ? 'text-brand-red font-semibold' : 'text-charcoal hover:text-brand-red' }} transition-colors">Admin</a>
                        @endif
                    @endauth
                </div>

                <!-- Right side: Auth -->
                <div class="hidden lg:flex items-center space-x-3">
                    @auth
                        <div class="relative" id="user-dropdown">
                            <button class="flex items-center space-x-3 px-3 py-2 rounded-sm hover:bg-light-neutral transition-colors" onclick="toggleDropdown()">
                                <div class="w-8 h-8 bg-brand-red rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium text-charcoal max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-body-grey text-xs transition-transform duration-200" id="dropdown-arrow"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-md border border-gray-200 hidden z-50 animate-fade-in-up" id="dropdown-menu">
                                <div class="p-4 border-b border-gray-100">
                                    <div class="text-sm font-bold text-charcoal truncate">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-body-grey truncate mt-1">{{ auth()->user()->email }}</div>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2.5 text-sm text-charcoal hover:bg-light-neutral hover:text-brand-red transition-colors">
                                        <i class="fas fa-user-circle mr-3 text-body-grey"></i>My Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm text-charcoal hover:bg-light-neutral hover:text-brand-red transition-colors">
                                            <i class="fas fa-sign-out-alt mr-3 text-body-grey"></i>Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-charcoal hover:text-brand-red transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="bg-brand-red text-white px-5 py-2.5 rounded-[60px] text-sm font-bold hover:opacity-90 transition-opacity">Get Started</a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="lg:hidden w-10 h-10 flex items-center justify-center" onclick="toggleMobileMenu()">
                    <div class="flex flex-col space-y-1.5">
                        <span class="w-6 h-0.5 bg-charcoal rounded transition-all" id="mobile-bar1"></span>
                        <span class="w-6 h-0.5 bg-charcoal rounded transition-all" id="mobile-bar2"></span>
                        <span class="w-6 h-0.5 bg-charcoal rounded transition-all" id="mobile-bar3"></span>
                    </div>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-backdrop" class="mobile-menu-backdrop hidden"></div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu-container" class="mobile-menu-container">
        <div class="p-5 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-brand-red rounded-full flex items-center justify-center">
                    <span class="text-white font-extrabold text-xs">SC</span>
                </div>
                <div>
                    <div class="text-base font-extrabold text-charcoal">SUMEDANG</div>
                    <div class="text-[10px] font-bold text-brand-red tracking-widest uppercase">Creative Center</div>
                </div>
            </div>
            <button onclick="toggleMobileMenu()" class="w-8 h-8 flex items-center justify-center"><i class="fas fa-times text-charcoal"></i></button>
        </div>
        
        @auth
        <div class="mx-5 mt-4 p-4 bg-light-neutral rounded-md">
            <div class="text-sm font-bold text-charcoal">{{ auth()->user()->name }}</div>
            <div class="text-xs text-body-grey mt-1">{{ auth()->user()->email }}</div>
        </div>
        @endauth
        
        <div class="p-5 space-y-1 overflow-y-auto" style="max-height:calc(100vh - 200px);">
            <div class="text-[11px] font-extrabold text-body-grey tracking-wider uppercase mb-3">Navigation</div>
            <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-brand-red/5 text-brand-red' : 'text-charcoal hover:bg-light-neutral' }}">
                <i class="fas fa-home mr-3 text-sm w-5"></i>Home
            </a>
            <a href="{{ route('sop') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium {{ request()->routeIs('sop') ? 'bg-brand-red/5 text-brand-red' : 'text-charcoal hover:bg-light-neutral' }}">
                <i class="fas fa-book mr-3 text-sm w-5"></i>SOP
            </a>
            @auth
                <a href="{{ route('booking.index') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium {{ request()->routeIs('booking.*') ? 'bg-brand-red/5 text-brand-red' : 'text-charcoal hover:bg-light-neutral' }}">
                    <i class="fas fa-calendar mr-3 text-sm w-5"></i>Bookings
                </a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.rooms') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium {{ request()->routeIs('admin.rooms') ? 'bg-brand-red/5 text-brand-red' : 'text-charcoal hover:bg-light-neutral' }}">
                        <i class="fas fa-door-open mr-3 text-sm w-5"></i>Rooms
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium {{ request()->is('admin*') && !request()->routeIs('admin.rooms') ? 'bg-brand-red/5 text-brand-red' : 'text-charcoal hover:bg-light-neutral' }}">
                        <i class="fas fa-shield mr-3 text-sm w-5"></i>Admin
                    </a>
                @endif
            @endauth

            <div class="text-[11px] font-extrabold text-body-grey tracking-wider uppercase mb-3 mt-6">Account</div>
            @auth
                <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium text-charcoal hover:bg-light-neutral">
                    <i class="fas fa-user-circle mr-3 text-sm w-5"></i>My Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-md text-sm font-medium text-charcoal hover:bg-light-neutral">
                        <i class="fas fa-sign-out-alt mr-3 text-sm w-5"></i>Sign Out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="flex items-center px-4 py-3 rounded-md text-sm font-medium text-charcoal hover:bg-light-neutral">
                    <i class="fas fa-sign-in-alt mr-3 text-sm w-5"></i>Sign In
                </a>
                <a href="{{ route('register') }}" class="block w-full bg-brand-red text-white text-center py-3 rounded-[2px] text-sm font-bold mt-2 hover:opacity-90">Create Account</a>
            @endauth

            <div class="mt-6 p-4 bg-light-neutral rounded-md">
                <div class="text-xs font-bold text-charcoal mb-1">Jam Operasional</div>
                <div class="text-xs text-body-grey">08:00 - 21:00 (Setiap Hari)</div>
                <div class="text-xs font-bold text-charcoal mb-1 mt-3">Kontak</div>
                <div class="text-xs text-body-grey">(022) 1234-5678</div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <div class="max-w-[1200px] mx-auto px-8 mt-6">
        @if(session('success'))
            <div class="border-l-4 border-green-600 bg-white p-4 mb-4 rounded-r-md">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3 text-lg"></i>
                    <div>
                        <p class="font-bold text-charcoal">Success</p>
                        <p class="text-body-grey text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="border-l-4 border-brand-red bg-white p-4 mb-4 rounded-r-md">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-brand-red mr-3 text-lg"></i>
                    <div>
                        <p class="font-bold text-charcoal">Error</p>
                        <p class="text-body-grey text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if($errors->any())
            <div class="border-l-4 border-brand-red bg-white p-4 mb-4 rounded-r-md">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-brand-red mr-3 text-lg mt-0.5"></i>
                    <div>
                        <p class="font-bold text-charcoal">Validation Error</p>
                        @foreach($errors->all() as $error)
                            <p class="text-body-grey text-sm mt-1">• {{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer: Charcoal Institutional Panel -->
    <footer class="bg-charcoal text-white mt-16">
        <div class="max-w-[1440px] mx-auto px-8 pt-16 pb-10">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                <!-- Brand -->
                <div>
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-brand-red rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/logoscc.jpeg') }}" alt="Logo" class="w-full h-full object-cover"
                                 onerror="this.style.display='none'; this.parentElement.innerHTML='<span class=\'text-white font-extrabold text-sm\'>SC</span>';">
                        </div>
                        <div>
                            <div class="text-lg font-extrabold text-white tracking-tight">SUMEDANG</div>
                            <div class="text-[10px] font-bold text-brand-red tracking-widest uppercase">Creative Center</div>
                        </div>
                    </a>
                    <p class="text-sm text-white/60 leading-relaxed mb-6 max-w-xs">
                        Pusat inovasi digital dan ruang kreatif premium untuk mengembangkan potensi masyarakat Sumedang.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 rounded-full border border-white/25 flex items-center justify-center hover:bg-brand-red hover:border-brand-red transition-colors"><i class="fab fa-instagram text-white/60 hover:text-white text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full border border-white/25 flex items-center justify-center hover:bg-brand-red hover:border-brand-red transition-colors"><i class="fab fa-facebook-f text-white/60 hover:text-white text-sm"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full border border-white/25 flex items-center justify-center hover:bg-brand-red hover:border-brand-red transition-colors"><i class="fab fa-youtube text-white/60 hover:text-white text-sm"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-base font-extrabold text-white uppercase tracking-wide mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-white/60 hover:text-white text-sm transition-colors">Home</a></li>
                        <li><a href="{{ route('sop') }}" class="text-white/60 hover:text-white text-sm transition-colors">SOP & Guidelines</a></li>
                        @auth
                            <li><a href="{{ route('booking.index') }}" class="text-white/60 hover:text-white text-sm transition-colors">My Bookings</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-white/60 hover:text-white text-sm transition-colors">Sign In</a></li>
                            <li><a href="{{ route('register') }}" class="text-white/60 hover:text-white text-sm transition-colors">Register</a></li>
                        @endauth
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-base font-extrabold text-white uppercase tracking-wide mb-6">Contact</h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-brand-red mr-3 mt-0.5"></i>
                            <span class="text-white/60">Jl. Cut Nyak Dien No. 2, Bunderan Binokasih</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-brand-red mr-3"></i>
                            <span class="text-white/60">(022) 1234-5678</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-brand-red mr-3"></i>
                            <span class="text-white/60">info@scc-sumedang.id</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Hours -->
                <div>
                    <h3 class="text-base font-extrabold text-white uppercase tracking-wide mb-6">Hours</h3>
                    <div class="border border-white/25 rounded-md p-5">
                        <div class="flex justify-between items-center">
                            <span class="text-white/60 text-sm">Senin - Minggu</span>
                            <span class="text-white font-bold text-sm">08:00 - 21:00</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="border-t border-white/25 mt-10 pt-8">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="text-white/40 text-xs">&copy; {{ date('Y') }} Sumedang Creative Center By Nugaduh Stack. All rights reserved.</div>
                    <div class="flex items-center space-x-6 text-xs">
                        <a href="#" class="text-white/40 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-white/40 hover:text-white transition-colors">Terms of Service</a>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <button onclick="scrollToTop()" class="text-white/40 hover:text-white text-sm transition-colors">
                        <i class="fas fa-arrow-up mr-1"></i> Back to Top
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <script>
        let mobileMenuOpen = false;
        function toggleMobileMenu() {
            const backdrop = document.getElementById('mobile-menu-backdrop');
            const container = document.getElementById('mobile-menu-container');
            mobileMenuOpen = !mobileMenuOpen;
            if (mobileMenuOpen) {
                backdrop.classList.remove('hidden');
                container.classList.add('open');
                document.body.style.overflow = 'hidden';
                document.getElementById('mobile-bar1').style.transform = 'rotate(45deg) translate(5px, 5px)';
                document.getElementById('mobile-bar2').style.opacity = '0';
                document.getElementById('mobile-bar3').style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                backdrop.classList.add('hidden');
                container.classList.remove('open');
                document.body.style.overflow = '';
                document.getElementById('mobile-bar1').style.transform = '';
                document.getElementById('mobile-bar2').style.opacity = '';
                document.getElementById('mobile-bar3').style.transform = '';
            }
        }
        document.getElementById('mobile-menu-backdrop').addEventListener('click', toggleMobileMenu);
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && mobileMenuOpen) toggleMobileMenu(); });

        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const arrow = document.getElementById('dropdown-arrow');
            if (menu) { menu.classList.toggle('hidden'); }
            if (arrow) { arrow.classList.toggle('rotate-180'); }
        }
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            const menu = document.getElementById('dropdown-menu');
            if (dropdown && menu && !dropdown.contains(event.target)) {
                menu.classList.add('hidden');
                const arrow = document.getElementById('dropdown-arrow');
                if (arrow) arrow.classList.remove('rotate-180');
            }
        });

        window.addEventListener('scroll', function() {
            const nav = document.getElementById('main-nav');
            if (window.scrollY > 10) { nav.classList.add('nav-scrolled'); } 
            else { nav.classList.remove('nav-scrolled'); }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelectorAll('input[type="date"]').forEach(input => { if (!input.value) input.min = today; });
        });

        function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
    </script>
    
    @yield('scripts')
</body>
</html>