@extends('layouts.app')

@section('title', 'Register - Sumedang Creative Center')

@section('styles')
<style>
    /* Modern Card Design - Sama seperti profile edit */
    .register-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    /* Elegant Form Inputs - Sama seperti profile edit */
    .form-input-register {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 13px 16px;
        width: 100%;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        font-size: 14px;
        color: #1f2937;
    }
    
    .form-input-register:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        background: #ffffff;
    }
    
    /* Elegant Labels - Sama seperti profile edit */
    .form-label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
        font-size: 13px;
        letter-spacing: 0.3px;
    }
    
    /* Enhanced Password Toggle - Sama seperti profile edit */
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
    
    /* Refined Password Strength - Sama seperti profile edit */
    .password-strength-container {
        margin-top: 8px;
    }
    
    .password-strength {
        height: 4px;
        border-radius: 2px;
        margin-top: 4px;
        transition: all 0.3s ease;
    }
    
    .password-strength.weak {
        background: linear-gradient(90deg, #ef4444 0%, #f87171 100%);
        width: 25%;
    }
    
    .password-strength.medium {
        background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%);
        width: 50%;
    }
    
    .password-strength.strong {
        background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
        width: 75%;
    }
    
    .password-strength.very-strong {
        background: linear-gradient(90deg, #059669 0%, #10b981 100%);
        width: 100%;
    }
    
    /* Error States - Sama seperti profile edit */
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
    
    /* Requirements List - Sama seperti profile edit */
    .requirements-list {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
    }
    
    .requirements-list li {
        padding: 6px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .requirements-list li:last-child {
        border-bottom: none;
    }
    
    /* Action Buttons - Sama seperti profile edit */
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
    
    /* Login Link Button - Mirip back button di profile edit */
    .btn-login {
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
    
    .btn-login:hover {
        border-color: #dc2626;
        color: #dc2626;
        transform: translateX(-2px);
    }
    
    /* Success Badge - Sama seperti profile edit */
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
                    <i class="fas fa-user-plus text-red-600 text-3xl"></i>
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight mb-2">
                    Create Account
                </h1>
                <p class="text-gray-600 text-sm lg:text-base">
                    Register to book rooms at Sumedang Creative Center
                </p>
            </div>
            
            <!-- Progress Indicator -->
            <div class="mt-6 h-1 w-full bg-gray-100 rounded-full overflow-hidden max-w-md mx-auto">
                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full transition-all duration-500" 
                     style="width: 100%" id="progress-bar"></div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="max-w-2xl mx-auto">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 
                            rounded-xl p-4 flex items-start gap-3 animate-fade-in">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        <p class="text-green-600 text-sm mt-1">You can now login with your new account.</p>
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
                        <p class="text-red-800 font-medium">Please fix the following errors:</p>
                        <ul class="text-red-600 text-sm mt-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <!-- Form Card -->
            <div class="register-card p-6 lg:p-8">
                <!-- Form -->
                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf
                    
                    <div class="space-y-8">
                        <!-- Personal Information Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-user-circle text-red-500"></i>
                                Personal Information
                            </h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user mr-2 text-gray-400"></i>Full Name
                                    </label>
                                    <input type="text" 
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           class="form-input-register @error('name') error-input @enderror"
                                           placeholder="Enter your full name"
                                           required>
                                    @error('name')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <!-- Email -->
                                <div>
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                                    </label>
                                    <input type="email" 
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           class="form-input-register @error('email') error-input @enderror"
                                           placeholder="Enter your email address"
                                           required>
                                    @error('email')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone-alt mr-2 text-gray-400"></i>Phone Number
                                    </label>
                                    <input type="tel" 
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           class="form-input-register @error('phone') error-input @enderror"
                                           placeholder="Enter phone number"
                                           required>
                                    @error('phone')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <!-- Address -->
                                <div>
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Address
                                    </label>
                                    <input type="text" 
                                           id="address"
                                           name="address"
                                           value="{{ old('address') }}"
                                           class="form-input-register @error('address') error-input @enderror"
                                           placeholder="Enter your address"
                                           required>
                                    @error('address')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password Section - Sama persis dengan profile edit -->
                        <div class="pt-6 border-t border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-key text-red-500"></i>
                                Account Security
                            </h3>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Password -->
                                <div>
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock-plus mr-2 text-gray-400"></i>Password
                                    </label>
                                    <div class="input-with-icon">
                                        <input type="password" 
                                               id="password"
                                               name="password"
                                               class="form-input-register @error('password') error-input @enderror pr-12"
                                               placeholder="Create new password"
                                               required
                                               oninput="checkPasswordStrength(this.value)">
                                        <button type="button" 
                                                class="password-toggle"
                                                onclick="togglePassword('password', this)"
                                                aria-label="Toggle password visibility">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength-container">
                                        <div id="password-strength-bar" class="password-strength"></div>
                                        <div id="password-strength-text" class="text-xs mt-2 font-medium"></div>
                                    </div>
                                    @error('password')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock-check mr-2 text-gray-400"></i>Confirm Password
                                    </label>
                                    <div class="input-with-icon">
                                        <input type="password" 
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               class="form-input-register pr-12 @error('password') error-input @enderror"
                                               placeholder="Confirm new password"
                                               required
                                               oninput="checkPasswordMatch()">
                                        <button type="button" 
                                                class="password-toggle"
                                                onclick="togglePassword('password_confirmation', this)"
                                                aria-label="Toggle password visibility">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="password-match" class="text-xs mt-2 font-medium"></div>
                                </div>
                            </div>
                            
                            <!-- Password Requirements - Sama persis dengan profile edit -->
                            <div class="requirements-list mt-6">
                                <h4 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-shield-check text-red-500"></i>
                                    Password Requirements
                                </h4>
                                <ul class="text-sm text-gray-600 space-y-2.5">
                                    <li id="req-length" class="flex items-center justify-between">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-circle text-[6px]"></i>
                                            Minimum 8 characters
                                        </span>
                                        <i class="fas fa-times text-gray-300"></i>
                                    </li>
                                    <li id="req-uppercase" class="flex items-center justify-between">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-circle text-[6px]"></i>
                                            One uppercase letter (A-Z)
                                        </span>
                                        <i class="fas fa-times text-gray-300"></i>
                                    </li>
                                    <li id="req-lowercase" class="flex items-center justify-between">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-circle text-[6px]"></i>
                                            One lowercase letter (a-z)
                                        </span>
                                        <i class="fas fa-times text-gray-300"></i>
                                    </li>
                                    <li id="req-number" class="flex items-center justify-between">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-circle text-[6px]"></i>
                                            One number (0-9)
                                        </span>
                                        <i class="fas fa-times text-gray-300"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Terms & Conditions -->
                        <div class="pt-6 border-t border-gray-100">
                            <div class="flex items-start">
                                <input 
                                    type="checkbox" 
                                    id="terms" 
                                    name="terms"
                                    required
                                    class="mt-0.5 h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="terms" class="ml-3 text-sm text-gray-700">
                                    I agree to the 
                                    <a href="#" class="text-red-600 hover:text-red-800 font-medium">Terms of Service</a> 
                                    and 
                                    <a href="#" class="text-red-600 hover:text-red-800 font-medium">Privacy Policy</a>
                                </label>
                            </div>
                            @error('terms')
                                <p class="error-text">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="flex flex-col lg:flex-row justify-between items-center pt-8 border-t border-gray-100">
                            <div class="mb-4 lg:mb-0">
                                <a href="{{ route('login') }}" class="btn-login">
                                    <i class="fas fa-arrow-left text-sm"></i>
                                    <span>Back to Login</span>
                                </a>
                            </div>
                            <div>
                                <button type="submit" 
                                        id="submitBtn"
                                        class="btn-primary px-8 py-3">
                                    <i class="fas fa-user-plus mr-2.5"></i>Create Account
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-medium ml-1">
                        Login here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize password strength check
        checkPasswordStrength(document.getElementById('password')?.value || '');
        
        // Check password confirmation
        const confirmInput = document.getElementById('password_confirmation');
        if (confirmInput) {
            confirmInput.addEventListener('input', checkPasswordMatch);
        }
        
        // Add animation to form elements
        animateFormElements();
        
        // Update progress bar
        updateProgressBar();
    });
    
    // Update progress bar
    function updateProgressBar() {
        const progressBar = document.getElementById('progress-bar');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '100%';
            }, 100);
        }
    }
    
    // Animate form elements
    function animateFormElements() {
        const inputs = document.querySelectorAll('.form-input-register');
        inputs.forEach((input, index) => {
            input.style.animationDelay = (index * 0.1) + 's';
            input.classList.add('animate-fade-in-up');
        });
    }
    
    // Toggle password visibility - Sama persis dengan profile edit
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
    
    // Enhanced password strength check - Sama persis dengan profile edit
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        const submitBtn = document.getElementById('submitBtn');
        
        // Reset all requirement indicators
        const requirements = {
            'length': document.getElementById('req-length'),
            'uppercase': document.getElementById('req-uppercase'),
            'lowercase': document.getElementById('req-lowercase'),
            'number': document.getElementById('req-number')
        };
        
        Object.values(requirements).forEach(el => {
            if (el) {
                const icon = el.querySelector('.fa-times, .fa-check');
                if (icon) {
                    icon.className = 'fas fa-times text-gray-300';
                    icon.parentElement.classList.remove('text-green-600');
                }
            }
        });
        
        // Check requirements
        const checks = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /[0-9]/.test(password)
        };
        
        // Update requirement indicators with animation
        Object.entries(checks).forEach(([key, isValid]) => {
            const requirement = requirements[key];
            if (requirement && isValid) {
                const icon = requirement.querySelector('.fa-times, .fa-check');
                if (icon) {
                    icon.className = 'fas fa-check text-green-500';
                    icon.parentElement.classList.add('text-green-600');
                }
            }
        });
        
        // Calculate strength score
        const score = Object.values(checks).filter(Boolean).length;
        
        // Determine strength level
        let strength = 0;
        let text = 'Enter a password';
        let colorClass = '';
        let percentage = 0;
        
        switch(score) {
            case 1:
                strength = 1;
                text = 'Very Weak';
                colorClass = 'weak';
                percentage = 25;
                break;
            case 2:
                strength = 2;
                text = 'Weak';
                colorClass = 'weak';
                percentage = 25;
                break;
            case 3:
                strength = 3;
                text = 'Medium';
                colorClass = 'medium';
                percentage = 50;
                break;
            case 4:
                strength = 4;
                text = 'Strong';
                colorClass = 'strong';
                percentage = 75;
                break;
        }
        
        // Special case for very strong passwords
        if (password.length >= 12 && score === 4) {
            strength = 5;
            text = 'Very Strong';
            colorClass = 'very-strong';
            percentage = 100;
        }
        
        // Update strength indicator
        if (strengthBar && strengthText) {
            strengthBar.className = `password-strength ${colorClass}`;
            strengthBar.style.width = `${percentage}%`;
            
            strengthText.textContent = text;
            strengthText.className = `text-xs mt-2 font-medium ${
                colorClass === 'weak' ? 'text-red-600' :
                colorClass === 'medium' ? 'text-yellow-600' :
                colorClass === 'strong' ? 'text-green-600' :
                colorClass === 'very-strong' ? 'text-emerald-600' : 'text-gray-600'
            }`;
        }
        
        // Enable/disable submit button
        if (submitBtn) {
            submitBtn.disabled = score < 4;
            if (score < 4) {
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            } else {
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        }
        
        // Check password match
        checkPasswordMatch();
    }
    
    // Enhanced password match check - Sama persis dengan profile edit
    function checkPasswordMatch() {
        const password = document.getElementById('password')?.value || '';
        const confirmPassword = document.getElementById('password_confirmation')?.value || '';
        const matchDiv = document.getElementById('password-match');
        const submitBtn = document.getElementById('submitBtn');
        
        if (!matchDiv) return;
        
        if (!confirmPassword) {
            matchDiv.textContent = '';
            matchDiv.className = 'text-xs mt-2 font-medium';
            return;
        }
        
        if (password === confirmPassword) {
            matchDiv.innerHTML = '<i class="fas fa-check-circle text-green-500 mr-1.5"></i> Passwords match';
            matchDiv.className = 'text-xs mt-2 font-medium text-green-600';
            
            if (submitBtn && password.length >= 8) {
                // Check if all password requirements are met
                const hasUppercase = /[A-Z]/.test(password);
                const hasLowercase = /[a-z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                
                if (password.length >= 8 && hasUppercase && hasLowercase && hasNumber) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                }
            }
        } else {
            matchDiv.innerHTML = '<i class="fas fa-times-circle text-red-500 mr-1.5"></i> Passwords do not match';
            matchDiv.className = 'text-xs mt-2 font-medium text-red-600';
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }
        }
    }
    
    // Form validation before submission - Sama persis dengan profile edit
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const password = document.getElementById('password')?.value || '';
        const confirmPassword = document.getElementById('password_confirmation')?.value || '';
        const termsChecked = document.getElementById('terms')?.checked || false;
        
        // Check terms
        if (!termsChecked) {
            e.preventDefault();
            showToast('You must agree to the Terms of Service!', 'error');
            return;
        }
        
        // Check password match
        if (password !== confirmPassword) {
            e.preventDefault();
            showToast('Passwords do not match!', 'error');
            return;
        }
        
        // Check password requirements
        if (password.length < 8) {
            e.preventDefault();
            showToast('Password must be at least 8 characters!', 'error');
            return;
        }
        
        // Check all password requirements
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        
        if (!hasUppercase || !hasLowercase || !hasNumber) {
            e.preventDefault();
            showToast('Password must contain uppercase, lowercase, and number!', 'error');
            return;
        }
    });
    
    // Toast notification - Sama persis dengan profile edit
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
</script>

<!-- Add animations to CSS - Sama persis dengan profile edit -->
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
    .form-input-register,
    .btn-primary,
    .btn-login,
    .password-toggle {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection