@extends('layouts.app')

@section('title', 'Login - Sumedang Creative Center')

@section('styles')
<style>
    /* Modern Card Design - Sama seperti register */
    .login-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    /* Elegant Form Inputs - Sama seperti register */
    .form-input-login {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 13px 16px;
        width: 100%;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        font-size: 14px;
        color: #1f2937;
    }
    
    .form-input-login:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        background: #ffffff;
    }
    
    /* Elegant Labels - Sama seperti register */
    .form-label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
        font-size: 13px;
        letter-spacing: 0.3px;
    }
    
    /* Enhanced Password Toggle - Sama seperti register */
    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 6px;
        transition: color 0.2s ease;
    }
    
    .password-toggle:hover {
        color: #dc2626;
    }
    
    .input-with-icon {
        position: relative;
    }
    
    /* Error States - Sama seperti register */
    .error-input {
        border-color: #ef4444 !important;
    }
    
    .error-text {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    /* Action Buttons - Sama seperti register */
    .btn-primary {
        background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        color: white;
        padding: 12px 28px;
        border-radius: 10px;
        font-weight: 500;
        border: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
    }
    
    .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.25);
    }
    
    .btn-primary:active:not(:disabled) {
        transform: translateY(0);
    }
    
    .btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15) !important;
    }
    
    /* Register Link Button - Mirip button di register */
    .btn-register {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: white;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        color: #6b7280;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s ease;
    }
    
    .btn-register:hover {
        border-color: #dc2626;
        color: #dc2626;
        transform: translateX(2px);
    }
    
    /* Success Badge - Sama seperti register */
    .success-badge {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-50/50 py-8">
    <div class="container mx-auto px-4 lg:px-6 max-w-4xl">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-red-50 to-red-100 
                            rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-user-alt text-red-600 text-3xl"></i>
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight mb-2">
                    Welcome Back
                </h1>
                <p class="text-gray-600 text-sm lg:text-base">
                    Login to access Sumedang Creative Center Booking System
                </p>
            </div>
            
            <!-- Progress Indicator -->
            <div class="mt-6 h-1 w-full bg-gray-100 rounded-full overflow-hidden max-w-md mx-auto">
                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full transition-all duration-500" 
                     style="width: 50%" id="progress-bar"></div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="max-w-md mx-auto">
            <!-- Success Message -->
            @if(session('status'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 
                            rounded-xl p-4 flex items-start gap-3 animate-fade-in">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 font-medium">{{ session('status') }}</p>
                        <p class="text-green-600 text-sm mt-1">You can now login with your credentials.</p>
                    </div>
                </div>
            @endif
            
            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 
                            rounded-xl p-4 flex items-start gap-3 animate-fade-in">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-red-800 font-medium">Login failed</p>
                        <ul class="text-red-600 text-sm mt-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <!-- Form Card -->
            <div class="login-card p-6 lg:p-8">
                <!-- Form -->
                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    
                    <div class="space-y-8">
                        <!-- Email Section -->
                        <div>
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                            </label>
                            <div class="input-with-icon">
                                <input type="email" 
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-input-login @error('email') error-input @enderror pr-12"
                                       placeholder="Enter your email address"
                                       required>
                            </div>
                            @error('email')
                                <p class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Password Section -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                                </label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-xs text-red-600 hover:text-red-800 font-medium">
                                    Forgot password?
                                </a>
                                @endif
                            </div>
                            <div class="input-with-icon">
                                <input type="password" 
                                       id="password"
                                       name="password"
                                       class="form-input-login @error('password') error-input @enderror pr-12"
                                       placeholder="Enter your password"
                                       required>
                                <button type="button" 
                                        class="password-toggle"
                                        onclick="togglePassword('password', this)"
                                        aria-label="Toggle password visibility">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="remember" 
                                name="remember"
                                class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                            <label for="remember" class="ml-3 text-sm text-gray-700">
                                Keep me logged in
                            </label>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="flex flex-col lg:flex-row justify-between items-center pt-8 border-t border-gray-100">
                            <div class="mb-4 lg:mb-0">
                                <a href="{{ route('register') }}" class="btn-register">
                                    <i class="fas fa-user-plus text-sm"></i>
                                    <span>Create Account</span>
                                </a>
                            </div>
                            <div>
                                <button type="submit" 
                                        class="btn-primary px-8 py-3">
                                    <i class="fas fa-sign-in-alt mr-2.5"></i>Login
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-red-600 hover:text-red-800 font-medium ml-1">
                        Register here
                    </a>
                </p>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} Sumedang Creative Center. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to form elements
        animateFormElements();
        
        // Update progress bar
        updateProgressBar();
        
        // Auto focus email field
        const emailField = document.getElementById('email');
        if (emailField && !emailField.value) {
            emailField.focus();
        }
    });
    
    // Update progress bar
    function updateProgressBar() {
        const progressBar = document.getElementById('progress-bar');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '50%';
            }, 100);
        }
    }
    
    // Animate form elements
    function animateFormElements() {
        const inputs = document.querySelectorAll('.form-input-login');
        inputs.forEach((input, index) => {
            input.style.animationDelay = (index * 0.1) + 's';
            input.classList.add('animate-fade-in-up');
        });
    }
    
    // Toggle password visibility - Sama persis dengan register
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');
        
        if (!input) return;
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
            button.classList.add('text-red-500');
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
            button.classList.remove('text-red-500');
        }
        
        // Add focus effect
        input.focus();
    }
    
    // Toast notification - Sama persis dengan register
    function showToast(message, type = 'info') {
        // Remove existing toast
        const existingToast = document.getElementById('custom-toast');
        if (existingToast) existingToast.remove();
        
        // Create toast
        const toast = document.createElement('div');
        toast.id = 'custom-toast';
        toast.className = `fixed top-6 right-6 z-50 px-6 py-4 rounded-xl shadow-lg 
                          transform translate-x-full transition-transform duration-300
                          ${type === 'error' ? 'bg-red-50 border border-red-200 text-red-800' : 
                            type === 'success' ? 'bg-green-50 border border-green-200 text-green-800' :
                            'bg-blue-50 border border-blue-200 text-blue-800'}`;
        
        toast.innerHTML = `
            <div class="flex items-center gap-3">
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 
                              type === 'success' ? 'fa-check-circle' : 
                              'fa-info-circle'} 
                   text-lg ${type === 'error' ? 'text-red-500' : 
                            type === 'success' ? 'text-green-500' : 
                            'text-blue-500'}"></i>
                <span class="font-medium">${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
        }, 10);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
    
    // Form validation before submission
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
        const email = document.getElementById('email')?.value || '';
        const password = document.getElementById('password')?.value || '';
        
        // Basic validation
        if (!email || !password) {
            e.preventDefault();
            showToast('Please fill in all fields!', 'error');
            return;
        }
        
        // Email format validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            showToast('Please enter a valid email address!', 'error');
            return;
        }
        
        // Password length validation
        if (password.length < 1) {
            e.preventDefault();
            showToast('Password is required!', 'error');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Logging in...';
            submitBtn.disabled = true;
        }
    });
</script>

<!-- Add animations to CSS - Sama persis dengan register -->
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fade-in {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.5s ease-out forwards;
    }
    
    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }
    
    /* Smooth transitions for all interactive elements */
    .form-input-login,
    .btn-primary,
    .btn-register,
    .password-toggle {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Spinner animation for loading state */
    .fa-spinner {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection