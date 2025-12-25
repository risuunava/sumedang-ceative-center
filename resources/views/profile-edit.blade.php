@extends('layouts.app')

@section('title', 'Edit Profile - Sumedang Creative Center')

@section('styles')
<style>
    /* Modern Card Design */
    .profile-edit-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    /* Elegant Form Inputs */
    .form-input-edit {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 13px 16px;
        width: 100%;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        font-size: 14px;
        color: #1f2937;
    }
    
    .form-input-edit:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        background: #ffffff;
    }
    
    .form-input-edit:disabled {
        background: #f9fafb;
        border-color: #e5e7eb;
        color: #6b7280;
        cursor: not-allowed;
    }
    
    /* Elegant Labels */
    .form-label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
        font-size: 13px;
        letter-spacing: 0.3px;
    }
    
    /* Modern Tabs */
    .tab-button-edit {
        position: relative;
        padding: 14px 28px;
        font-weight: 500;
        color: #6b7280;
        transition: all 0.25s ease;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 15px;
    }
    
    .tab-button-edit:hover {
        color: #dc2626;
    }
    
    .tab-button-edit.active {
        color: #dc2626;
        font-weight: 600;
    }
    
    .tab-button-edit.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 3px;
        background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        border-radius: 3px 3px 0 0;
    }
    
    /* Enhanced Password Toggle */
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
    
    /* Refined Password Strength */
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
    
    /* Beautiful Avatar */
    .current-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        font-weight: bold;
        margin: 0 auto 20px;
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.15);
        border: 4px solid white;
    }
    
    /* Error States */
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
    
    /* Success States */
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
    
    /* Requirements List */
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
    
    /* Action Buttons */
    .btn-secondary {
        background: white;
        border: 1.5px solid #e5e7eb;
        color: #374151;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.25s ease;
    }
    
    .btn-secondary:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        transform: translateY(-1px);
    }
    
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
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.25);
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    /* Back Button Enhancement */
    .btn-back {
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
    
    .btn-back:hover {
        border-color: #dc2626;
        color: #dc2626;
        transform: translateX(-2px);
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-50/50 py-8">
    <div class="container mx-auto px-4 lg:px-6 max-w-6xl">
        <!-- Page Header -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight mb-2">
                        Edit Profile
                    </h1>
                    <p class="text-gray-600 text-sm lg:text-base">
                        Manage your personal information and security settings
                    </p>
                </div>
                <a href="{{ route('profile.index') }}" class="btn-back self-start lg:self-center">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Back to Profile</span>
                </a>
            </div>
            
            <!-- Progress Indicator -->
            <div class="h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full transition-all duration-500" 
                     style="width: 50%" id="progress-bar"></div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="max-w-4xl mx-auto">
            <!-- Tab Navigation -->
            <div class="flex justify-center mb-10">
                <div class="inline-flex bg-gray-50 rounded-xl p-1 border border-gray-200">
                    <button class="tab-button-edit active" id="tab-edit-info" onclick="switchTab('info')">
                        <i class="fas fa-user-edit mr-2.5"></i>Personal Information
                    </button>
                    <button class="tab-button-edit" id="tab-edit-password" onclick="switchTab('password')">
                        <i class="fas fa-key mr-2.5"></i>Security & Password
                    </button>
                </div>
            </div>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 
                            rounded-xl p-4 flex items-start gap-3 animate-fade-in">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        <p class="text-green-600 text-sm mt-1">Your changes have been saved successfully.</p>
                    </div>
                </div>
            @endif
            
            <!-- Personal Information Tab -->
            <div id="content-edit-info" class="tab-content-edit">
                <div class="profile-edit-card p-6 lg:p-8">
                    <!-- Avatar Section -->
                    <div class="text-center mb-10">
                        <div class="current-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <p class="text-gray-500 text-sm mt-2">Your profile picture is generated from your initials</p>
                    </div>
                    
                    <!-- Form -->
                    <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-8">
                            <!-- Name & Email -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>Full Name
                                    </label>
                                    <input type="text" 
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $user->name) }}"
                                           class="form-input-edit @error('name') error-input @enderror"
                                           placeholder="Enter your full name"
                                           required>
                                    @error('name')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                                    </label>
                                    <input type="email" 
                                           id="email"
                                           name="email"
                                           value="{{ old('email', $user->email) }}"
                                           class="form-input-edit @error('email') error-input @enderror"
                                           placeholder="Enter your email address"
                                           required>
                                    @error('email')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Phone & Member Since -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone-alt mr-2 text-gray-400"></i>Phone Number
                                    </label>
                                    <input type="tel" 
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone', $user->phone) }}"
                                           class="form-input-edit @error('phone') error-input @enderror"
                                           placeholder="(Optional) Enter phone number">
                                    @error('phone')
                                        <p class="error-text">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="form-label">
                                        <i class="fas fa-calendar-star mr-2 text-gray-400"></i>Member Since
                                    </label>
                                    <input type="text" 
                                           value="{{ $user->created_at->format('d F Y') }}"
                                           class="form-input-edit"
                                           disabled>
                                    <p class="text-gray-500 text-xs mt-2">You joined us on this date</p>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div>
                                <label for="address" class="form-label">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Address
                                </label>
                                <textarea id="address"
                                          name="address"
                                          rows="3"
                                          class="form-input-edit @error('address') error-input @enderror"
                                          placeholder="(Optional) Enter your full address">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <p class="error-text">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="flex flex-col lg:flex-row justify-between items-center pt-8 border-t border-gray-100">
                                <div class="mb-4 lg:mb-0">
                                    <p class="text-sm text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-info-circle text-blue-500"></i>
                                        Required fields are marked with an asterisk (*)
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ route('profile.index') }}" 
                                       class="btn-secondary px-8 py-3 text-center">
                                        Cancel
                                    </a>
                                    <button type="submit" 
                                            class="btn-primary px-8 py-3">
                                        <i class="fas fa-save mr-2.5"></i>Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Change Password Tab -->
            <div id="content-edit-password" class="tab-content-edit hidden">
                <div class="profile-edit-card p-6 lg:p-8">
                    <!-- Password Header -->
                    <div class="text-center mb-10">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-red-50 to-red-100 
                                    rounded-full flex items-center justify-center mb-5">
                            <i class="fas fa-key text-red-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Update Password</h3>
                        <p class="text-gray-600">Secure your account with a new password</p>
                    </div>
                    
                    <!-- Password Form -->
                    <form action="{{ route('profile.update-password') }}" method="POST" id="passwordForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-8">
                            <!-- Current Password -->
                            <div>
                                <label for="current_password" class="form-label">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>Current Password
                                </label>
                                <div class="input-with-icon">
                                    <input type="password" 
                                           id="current_password"
                                           name="current_password"
                                           class="form-input-edit @error('current_password') error-input @enderror pr-12"
                                           placeholder="Enter your current password"
                                           required>
                                    <button type="button" 
                                            class="password-toggle"
                                            onclick="togglePassword('current_password', this)"
                                            aria-label="Toggle password visibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="error-text">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- New & Confirm Password -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock-plus mr-2 text-gray-400"></i>New Password
                                    </label>
                                    <div class="input-with-icon">
                                        <input type="password" 
                                               id="password"
                                               name="password"
                                               class="form-input-edit @error('password') error-input @enderror pr-12"
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
                                
                                <div>
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock-check mr-2 text-gray-400"></i>Confirm Password
                                    </label>
                                    <div class="input-with-icon">
                                        <input type="password" 
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               class="form-input-edit pr-12 @error('password') error-input @enderror"
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
                            
                            <!-- Password Requirements -->
                            <div class="requirements-list">
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
                            
                            <!-- Form Actions -->
                            <div class="flex flex-col lg:flex-row justify-between items-center pt-8 border-t border-gray-100">
                                <div class="mb-4 lg:mb-0">
                                    <p class="text-sm text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-exclamation-triangle text-amber-500"></i>
                                        After updating, you'll stay logged in
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button type="button" 
                                            onclick="switchTab('info')"
                                            class="btn-secondary px-8 py-3">
                                        <i class="fas fa-arrow-left mr-2.5"></i>Back
                                    </button>
                                    <button type="submit" 
                                            id="submitPasswordBtn"
                                            class="btn-primary px-8 py-3">
                                        <i class="fas fa-key mr-2.5"></i>Update Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
        
        // Update progress bar based on active tab
        updateProgressBar();
        
        // Add animation to form elements
        animateFormElements();
    });
    
    // Update progress bar
    function updateProgressBar(percentage = 50) {
        const progressBar = document.getElementById('progress-bar');
        if (progressBar) {
            progressBar.style.width = percentage + '%';
        }
    }
    
    // Animate form elements
    function animateFormElements() {
        const inputs = document.querySelectorAll('.form-input-edit');
        inputs.forEach((input, index) => {
            input.style.animationDelay = (index * 0.1) + 's';
            input.classList.add('animate-fade-in-up');
        });
    }
    
    // Tab switching with animation
    function switchTab(tab) {
        // Update progress bar
        updateProgressBar(tab === 'info' ? 50 : 100);
        
        // Hide all tab contents with fade out
        document.querySelectorAll('.tab-content-edit').forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('animate-fade-in');
        });
        
        // Remove active class from all tabs
        document.querySelectorAll('.tab-button-edit').forEach(button => {
            button.classList.remove('active');
        });
        
        // Show selected tab content with fade in
        setTimeout(() => {
            const activeContent = document.getElementById(`content-edit-${tab}`);
            if (activeContent) {
                activeContent.classList.remove('hidden');
                setTimeout(() => {
                    activeContent.classList.add('animate-fade-in');
                }, 10);
            }
        }, 150);
        
        // Add active class to selected tab
        const activeTab = document.getElementById(`tab-edit-${tab}`);
        if (activeTab) {
            activeTab.classList.add('active');
        }
    }
    
    // Toggle password visibility with animation
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
    
    // Enhanced password strength check
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        const submitBtn = document.getElementById('submitPasswordBtn');
        
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
    
    // Enhanced password match check
    function checkPasswordMatch() {
        const password = document.getElementById('password')?.value || '';
        const confirmPassword = document.getElementById('password_confirmation')?.value || '';
        const matchDiv = document.getElementById('password-match');
        const submitBtn = document.getElementById('submitPasswordBtn');
        
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
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
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
    
    // Form validation before submission
    document.getElementById('passwordForm')?.addEventListener('submit', function(e) {
        const password = document.getElementById('password')?.value || '';
        const confirmPassword = document.getElementById('password_confirmation')?.value || '';
        
        if (password !== confirmPassword) {
            e.preventDefault();
            showToast('Passwords do not match!', 'error');
            return;
        }
        
        if (password.length < 8) {
            e.preventDefault();
            showToast('Password must be at least 8 characters!', 'error');
            return;
        }
        
        // Check all requirements
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        
        if (!hasUppercase || !hasLowercase || !hasNumber) {
            e.preventDefault();
            showToast('Password must contain uppercase, lowercase, and number!', 'error');
            return;
        }
    });
    
    // Toast notification
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

<!-- Add animations to CSS -->
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
    .form-input-edit,
    .btn-primary,
    .btn-secondary,
    .password-toggle,
    .tab-button-edit {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection