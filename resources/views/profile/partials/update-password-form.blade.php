<section class="profile-section">
    <header class="profile-header">
        <div class="header-icon">
            <i class="bi bi-person-circle"></i>
        </div>
        <div>
            <h2 class="profile-title">
                {{ __('Profile Information') }}
            </h2>
            <p class="profile-subtitle">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>
    </header>

    <!-- Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Main Profile Form -->
    <form method="post" action="{{ route('profile.update') }}" class="profile-form mt-5">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div class="form-group">
            <div class="form-label-group">
                <i class="bi bi-person-fill"></i>
                <label for="name" class="form-label">{{ __('Full Name') }}</label>
            </div>
            <div class="input-group">
                <input id="name" 
                       name="name" 
                       type="text" 
                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Enter your full name">
                <div class="input-icon">
                    <i class="bi bi-check-circle-fill text-success" id="name-valid" style="display: none;"></i>
                    <i class="bi bi-exclamation-circle-fill text-danger" id="name-invalid" style="display: none;"></i>
                </div>
            </div>
            @error('name')
                <div class="error-message">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
            <div class="form-text">This is how your name will appear on your profile</div>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <div class="form-label-group">
                <i class="bi bi-envelope-fill"></i>
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
            </div>
            <div class="input-group">
                <input id="email" 
                       name="email" 
                       type="email" 
                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       autocomplete="username"
                       placeholder="Enter your email address">
                <div class="input-icon">
                    @if($user->hasVerifiedEmail())
                        <span class="verified-badge" data-bs-toggle="tooltip" title="Email Verified">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </span>
                    @endif
                </div>
            </div>
            
            @error('email')
                <div class="error-message">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror

            <!-- Email Verification Status -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-alert">
                    <div class="alert-icon">
                        <i class="bi bi-shield-exclamation"></i>
                    </div>
                    <div class="alert-content">
                        <strong>{{ __('Email Not Verified') }}</strong>
                        <p>{{ __('Your email address is not verified. Please check your email for the verification link.') }}</p>
                        <button form="send-verification" class="btn-verification">
                            <i class="bi bi-send-check"></i>
                            {{ __('Resend Verification Email') }}
                        </button>
                        
                        @if (session('status') === 'verification-link-sent')
                            <div class="verification-success">
                                <i class="bi bi-check-circle"></i>
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                </div>
            @elseif($user->hasVerifiedEmail())
                <div class="verification-success-alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ __('Your email address is verified.') }}
                </div>
            @endif
        </div>

        <!-- Save Button & Status -->
        <div class="form-actions">
            <button type="submit" class="btn-save" id="saveBtn">
                <i class="bi bi-save2"></i>
                {{ __('Save Changes') }}
            </button>
            
            <!-- Success Message -->
            @if (session('status') === 'profile-updated')
                <div class="success-toast" id="successToast">
                    <div class="toast-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-content">
                        <strong>{{ __('Success!') }}</strong>
                        <p>{{ __('Your profile has been updated successfully.') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </form>
</section>

<style>
    .profile-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #eaeaea;
    }
    
    .profile-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f2f5;
    }
    
    .header-icon {
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }
    
    .profile-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }
    
    .profile-subtitle {
        color: #666;
        font-size: 0.95rem;
        margin-top: 5px;
        margin-bottom: 0;
    }
    
    .profile-form {
        max-width: 600px;
    }
    
    .form-group {
        margin-bottom: 30px;
    }
    
    .form-label-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .form-label-group i {
        color: #4361ee;
        font-size: 18px;
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        font-size: 1rem;
        margin: 0;
    }
    
    .input-group {
        position: relative;
    }
    
    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e1e5eb;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }
    
    .form-control:focus {
        border-color: #4361ee;
        background: white;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        outline: none;
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .form-control.is-valid {
        border-color: #4ade80;
    }
    
    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
    }
    
    .verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #d1fae5;
        color: #065f46;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .form-text {
        color: #6c757d;
        font-size: 0.85rem;
        margin-top: 5px;
        margin-left: 28px;
    }
    
    .verification-alert {
        background: #fff3cd;
        border: 1px solid #ffecb5;
        border-radius: 10px;
        padding: 15px;
        margin-top: 15px;
        display: flex;
        gap: 15px;
    }
    
    .alert-icon {
        color: #ffc107;
        font-size: 24px;
    }
    
    .alert-content {
        flex: 1;
    }
    
    .alert-content strong {
        color: #856404;
        display: block;
        margin-bottom: 5px;
    }
    
    .alert-content p {
        color: #856404;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .btn-verification {
        background: #ffc107;
        color: #856404;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-verification:hover {
        background: #e0a800;
        transform: translateY(-1px);
    }
    
    .verification-success {
        color: #28a745;
        font-size: 0.9rem;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .verification-success-alert {
        background: #d1fae5;
        color: #065f46;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .form-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #f0f2f5;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.2);
    }
    
    .btn-save:active {
        transform: translateY(0);
    }
    
    .success-toast {
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideIn 0.5s ease;
    }
    
    .toast-icon {
        color: #10b981;
        font-size: 24px;
    }
    
    .toast-content strong {
        color: #065f46;
        display: block;
        margin-bottom: 3px;
    }
    
    .toast-content p {
        color: #065f46;
        font-size: 0.9rem;
        margin: 0;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Tooltip Styling */
    [data-bs-toggle="tooltip"] {
        cursor: help;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-section {
            padding: 20px;
        }
        
        .profile-header {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        
        .header-icon {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }
        
        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-save {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(tooltip => {
            new bootstrap.Tooltip(tooltip);
        });
        
        // Name validation on input
        const nameInput = document.getElementById('name');
        const nameValidIcon = document.getElementById('name-valid');
        const nameInvalidIcon = document.getElementById('name-invalid');
        
        nameInput.addEventListener('input', function() {
            const name = this.value.trim();
            if (name.length >= 2) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                nameValidIcon.style.display = 'block';
                nameInvalidIcon.style.display = 'none';
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
                nameValidIcon.style.display = 'none';
                nameInvalidIcon.style.display = 'block';
            }
        });
        
        // Auto-hide success toast
        const successToast = document.getElementById('successToast');
        if (successToast) {
            setTimeout(() => {
                successToast.style.transition = 'opacity 0.5s ease';
                successToast.style.opacity = '0';
                setTimeout(() => successToast.remove(), 500);
            }, 4000);
        }
        
        // Form submission loading state
        const form = document.querySelector('.profile-form');
        const saveBtn = document.getElementById('saveBtn');
        
        form.addEventListener('submit', function() {
            saveBtn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Saving...';
            saveBtn.disabled = true;
        });
        
        // Add spin animation for loading icon
        const style = document.createElement('style');
        style.textContent = `
            .bi-arrow-repeat.spin {
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    });
</script>