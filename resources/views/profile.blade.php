@extends('layouts.app')

@section('title', 'My Profile - Sumedang Creative Center')

@section('styles')
<style>
    .profile-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(220, 38, 38, 0.15);
        box-shadow: 0 8px 32px rgba(220, 38, 38, 0.08);
    }
    
    .avatar-gradient {
        background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        box-shadow: 0 4px 20px rgba(220, 38, 38, 0.3);
    }
    
    .stat-card {
        background: white;
        border: 1px solid rgba(241, 245, 249, 0.8);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #DC2626 0%, #7F1D1D 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(220, 38, 38, 0.12);
    }
    
    .stat-card:hover::before {
        opacity: 1;
    }
    
    .booking-card {
        background: white;
        border: 1px solid rgba(241, 245, 249, 0.8);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .booking-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #DC2626 0%, #7F1D1D 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .booking-card:hover {
        transform: translateX(8px);
        border-color: rgba(220, 38, 38, 0.3);
        box-shadow: 0 8px 30px rgba(220, 38, 38, 0.1);
    }
    
    .booking-card:hover::before {
        opacity: 1;
    }
    
    .badge-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }
    
    .badge-confirmed {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .badge-cancelled {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .badge-completed {
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
        color: #3730a3;
        border: 1px solid rgba(99, 102, 241, 0.3);
    }
    
    .tab-button {
        position: relative;
        padding: 12px 24px;
        font-weight: 500;
        color: #64748b;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: transparent;
        border: none;
        cursor: pointer;
    }
    
    .tab-button.active {
        color: #dc2626;
        font-weight: 600;
    }
    
    .tab-button.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 3px;
        background: linear-gradient(90deg, #DC2626 0%, #7F1D1D 100%);
        border-radius: 3px 3px 0 0;
    }
    
    .form-input-profile {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 16px;
        width: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }
    
    .form-input-profile:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.15);
        transform: translateY(-1px);
    }
    
    .tab-content {
        animation: fadeInUp 0.3s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .gradient-text-red {
        background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50/50 via-white to-gray-50/30 py-8">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Profile</h1>
            <p class="text-gray-600">Manage your personal information and booking history</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Profile Info -->
            <div class="lg:col-span-1">
                <div class="profile-card rounded-2xl p-6 shadow-xl sticky top-24">
                    <!-- Avatar & Basic Info -->
                    <div class="text-center mb-6">
                        <div class="relative inline-flex">
                            <div class="w-24 h-24 avatar-gradient rounded-full flex items-center justify-center text-white text-3xl font-bold mb-4 shadow-lg group relative overflow-hidden">
                                <span class="relative z-10">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="absolute -inset-2 bg-gradient-to-r from-red-400 to-red-600 rounded-full blur opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
                        <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100 to-red-50 text-red-800 border border-red-200">
                                <i class="fas fa-user-circle mr-1.5"></i>
                                {{ $user->is_admin ? 'Administrator' : 'Premium Member' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="stat-card rounded-xl p-5 text-center">
                            <div class="text-2xl font-bold text-gray-900 mb-1 gradient-text-red">{{ $totalBookings }}</div>
                            <div class="text-gray-600 text-sm font-medium">Total Bookings</div>
                        </div>
                        <div class="stat-card rounded-xl p-5 text-center">
                            <div class="text-2xl font-bold text-gray-900 mb-1 gradient-text-red">
                                {{ $userBookings->where('status', 'confirmed')->count() }}
                            </div>
                            <div class="text-gray-600 text-sm font-medium">Confirmed</div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="space-y-3">
                        <a href="{{ route('profile.edit') }}" 
                           class="group relative flex items-center justify-center px-4 py-3 rounded-xl font-medium overflow-hidden transition-all duration-300">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-700 to-red-600 rounded-xl"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-red-500 via-red-600 to-red-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                            <div class="relative flex items-center text-white">
                                <i class="fas fa-edit mr-2.5 group-hover:rotate-12 transition-transform duration-300"></i>
                                Edit Profile
                            </div>
                        </a>
                        <a href="{{ route('booking.index') }}" 
                           class="group flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-50/80 to-red-100/80 text-red-700 rounded-xl font-medium hover:from-red-100 hover:to-red-200 transition-all duration-300 border border-red-200/50">
                            <i class="fas fa-calendar-check mr-2.5 group-hover:scale-110 transition-transform duration-300"></i>
                            View All Bookings
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Content -->
            <div class="lg:col-span-2">
                <!-- Tabs dengan Glass Effect -->
                <div class="flex border-b border-gray-200 mb-6 bg-white/50 backdrop-blur-sm rounded-t-2xl p-1">
                    <button class="tab-button active" id="tab-profile">
                        <i class="fas fa-user-circle mr-2.5"></i>Profile Information
                    </button>
                    <button class="tab-button" id="tab-bookings">
                        <i class="fas fa-calendar-day mr-2.5"></i>Recent Bookings
                    </button>
                </div>
                
                <!-- Profile Information Tab -->
                <div id="content-profile" class="tab-content">
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-id-card mr-2.5 text-red-500"></i>Personal Information
                            </h3>
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                                <i class="fas fa-user text-red-500"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-user-tag mr-2 text-gray-400"></i>Full Name
                                    </label>
                                    <div class="form-input-profile group-hover:border-red-300 transition-colors duration-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-user text-gray-400 mr-3"></i>
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                                    </label>
                                    <div class="form-input-profile group-hover:border-red-300 transition-colors duration-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-at text-gray-400 mr-3"></i>
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-phone mr-2 text-gray-400"></i>Phone Number
                                    </label>
                                    <div class="form-input-profile group-hover:border-red-300 transition-colors duration-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-mobile-alt text-gray-400 mr-3"></i>
                                            {{ $user->phone ?? 'Not set' }}
                                            @if(!$user->phone)
                                                <span class="ml-2 text-xs text-red-500 font-medium">(Recommended to set)</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>Member Since
                                    </label>
                                    <div class="form-input-profile group-hover:border-red-300 transition-colors duration-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-clock text-gray-400 mr-3"></i>
                                            {{ $user->created_at->format('d F Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Address
                                </label>
                                <div class="form-input-profile group-hover:border-red-300 transition-colors duration-300 min-h-[85px]">
                                    <div class="flex items-start">
                                        <i class="fas fa-home text-gray-400 mr-3 mt-1"></i>
                                        <div class="flex-1">
                                            {{ $user->address ?? 'Not set' }}
                                            @if(!$user->address)
                                                <div class="mt-2 text-xs text-red-500 font-medium">(Add your address for faster booking process)</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Bookings Tab -->
                <div id="content-bookings" class="tab-content hidden">
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center">
                                <h3 class="text-lg font-semibold text-gray-900 mr-3">Recent Bookings</h3>
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                                    <i class="fas fa-calendar text-red-500"></i>
                                </div>
                            </div>
                            <a href="{{ route('booking.index') }}" 
                               class="group flex items-center text-red-600 hover:text-red-700 text-sm font-medium px-3 py-2 rounded-lg hover:bg-red-50 transition-all duration-300">
                                View All <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                            </a>
                        </div>
                        
                        @if($userBookings->count() > 0)
                            <div class="space-y-4">
                                @foreach($userBookings as $booking)
                                <div class="booking-card rounded-xl p-5 group cursor-pointer" onclick="window.location='{{ route('booking.show', $booking) }}'">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-start">
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center mr-3 mt-1">
                                                    <i class="fas fa-door-closed text-red-500"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-900 group-hover:text-red-600 transition-colors duration-300">
                                                        {{ $booking->room->name ?? 'Unknown Room' }}
                                                    </h4>
                                                    <div class="flex flex-wrap gap-3 mt-2">
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fas fa-calendar mr-2 text-red-400"></i>
                                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}
                                                        </div>
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fas fa-clock mr-2 text-red-400"></i>
                                                            {{ $booking->start_time }} - {{ $booking->end_time }}
                                                        </div>
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i class="fas fa-users mr-2 text-red-400"></i>
                                                            {{ $booking->participants_count }} participants
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right pl-4">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium 
                                                @if($booking->status == 'pending') badge-pending
                                                @elseif($booking->status == 'confirmed') badge-confirmed
                                                @elseif($booking->status == 'cancelled') badge-cancelled
                                                @elseif($booking->status == 'completed') badge-completed
                                                @endif">
                                                <i class="fas fa-circle text-[6px] mr-1.5"></i>
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                            <div class="mt-3 text-lg font-bold text-gray-900">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                        <div class="text-sm text-gray-500">
                                            Booking ID: <span class="font-mono font-medium">{{ $booking->booking_code }}</span>
                                        </div>
                                        <div class="flex items-center text-red-600 group-hover:text-red-700">
                                            <span class="text-sm font-medium mr-2">View Details</span>
                                            <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="relative inline-flex mb-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-50 rounded-full flex items-center justify-center shadow-sm">
                                        <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                                    </div>
                                    <div class="absolute -inset-2 bg-gradient-to-r from-gray-300 to-gray-400 rounded-full blur opacity-20"></div>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 mb-2">No Bookings Yet</h4>
                                <p class="text-gray-600 mb-6 max-w-md mx-auto">You haven't made any bookings yet. Start exploring our premium creative spaces!</p>
                                <a href="{{ route('home') }}" 
                                   class="group inline-flex items-center px-5 py-2.5 rounded-xl font-medium shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-500 via-red-600 to-red-500 rounded-xl"></div>
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-700 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                                    <div class="relative flex items-center text-white">
                                        <i class="fas fa-search mr-2.5 group-hover:scale-110 transition-transform duration-300"></i>
                                        Browse Available Rooms
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab Switching
        const tabs = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                // Hide all content
                contents.forEach(c => {
                    c.classList.add('hidden');
                    c.style.animation = 'none';
                    setTimeout(() => {
                        c.style.animation = '';
                    }, 10);
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding content with animation
                const tabId = this.id.replace('tab-', '');
                const content = document.getElementById(`content-${tabId}`);
                content.classList.remove('hidden');
                content.style.animation = 'fadeInUp 0.3s ease-out';
            });
        });
        
        // Add hover effect to booking cards
        const bookingCards = document.querySelectorAll('.booking-card');
        bookingCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
        
        // Add click effect to stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'translateY(-4px) scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-4px)';
                }, 150);
            });
        });
        
        // Add smooth scroll to top when switching tabs
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                window.scrollTo({
                    top: document.querySelector('.tab-button.active').offsetTop - 100,
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endsection