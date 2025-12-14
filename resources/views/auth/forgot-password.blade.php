<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Todo List Pro</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --warning-color: #f59e0b;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .reset-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease;
        }
        
        .reset-card:hover {
            transform: translateY(-5px);
        }
        
        .reset-header {
            background: linear-gradient(135deg, var(--warning-color), #fbbf24);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .reset-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.1;
        }
        
        .reset-header h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 15px;
            position: relative;
        }
        
        .reset-header p {
            opacity: 0.9;
            font-size: 0.95rem;
            position: relative;
            margin-bottom: 0;
        }
        
        .reset-body {
            padding: 40px 30px;
        }
        
        .info-message {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            color: #92400e;
            font-size: 0.95rem;
            display: flex;
            gap: 15px;
        }
        
        .info-icon {
            color: var(--warning-color);
            font-size: 24px;
            flex-shrink: 0;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control-custom {
            width: 100%;
            padding: 14px 20px;
            border: 2px solid #e1e5eb;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        
        .form-control-custom:focus {
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            outline: none;
        }
        
        .form-control-custom.has-error {
            border-color: #dc3545;
        }
        
        .input-icon {
            position: absolute;
            right: 20px;
            top: 42px;
            color: #adb5bd;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }
        
        .error-message i {
            margin-right: 5px;
        }
        
        .btn-reset {
            background: linear-gradient(135deg, var(--warning-color), #fbbf24);
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
        }
        
        .btn-reset:active {
            transform: translateY(0);
        }
        
        .reset-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 0.9rem;
        }
        
        .reset-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .reset-footer a:hover {
            text-decoration: underline;
        }
        
        .alert-message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        @media (max-width: 576px) {
            .reset-card {
                max-width: 100%;
            }
            
            .reset-header,
            .reset-body {
                padding: 30px 20px;
            }
            
            .reset-header h1 {
                font-size: 1.75rem;
            }
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            position: relative;
        }
        
        .logo-icon {
            font-size: 2.5rem;
            color: white;
            margin-right: 10px;
        }
        
        .back-to-login {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-top: 15px;
        }
        
        .back-to-login:hover {
            text-decoration: underline;
        }
        
        .success-animation {
            animation: successPulse 2s ease-in-out;
        }
        
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <!-- Header -->
        <div class="reset-header">
            <div class="logo-container">
                <i class="bi bi-key-fill logo-icon"></i>
                <h1>Reset Password</h1>
            </div>
            <p>Enter your email to receive a password reset link</p>
        </div>
        
        <!-- Body -->
        <div class="reset-body">
            <!-- Info Message -->
            <div class="info-message">
                <i class="bi bi-info-circle info-icon"></i>
                <div>
                    <strong>Forgot your password?</strong>
                    No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>
            </div>
            
            <!-- Session Status -->
            @if(session('status'))
                <div class="alert-message alert-success success-animation">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <strong>Email sent successfully!</strong>
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            
            <!-- Error Alert -->
            @if($errors->any())
                <div class="alert-message alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        <strong>Oops!</strong> Please fix the following errors:
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}" id="resetForm">
                @csrf
                
                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="bi bi-envelope me-2"></i>Email Address
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        class="form-control-custom {{ $errors->has('email') ? 'has-error' : '' }}"
                        placeholder="Enter your registered email address">
                    <i class="bi bi-envelope input-icon"></i>
                    
                    @error('email')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-reset" id="submitBtn">
                    <i class="bi bi-send-check"></i>
                    {{ __('Send Reset Link') }}
                </button>
            </form>
            
            <!-- Footer -->
            <div class="reset-footer">
                <a href="{{ route('login') }}" class="back-to-login">
                    <i class="bi bi-arrow-left"></i>
                    Back to Login
                </a>
                <br>
                <a href="{{ url('/') }}">← Back to Homepage</a>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert-message');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
            
            // Form submission loading state
            const form = document.getElementById('resetForm');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', function() {
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split spin"></i> Sending Email...';
                submitBtn.disabled = true;
            });
            
            // Email validation on input
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                const email = this.value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (emailRegex.test(email)) {
                    this.classList.remove('has-error');
                    this.classList.add('is-valid');
                } else if (email !== '') {
                    this.classList.add('has-error');
                    this.classList.remove('is-valid');
                } else {
                    this.classList.remove('has-error', 'is-valid');
                }
            });
            
            // Add spin animation for loading icon
            const style = document.createElement('style');
            style.textContent = `
                .bi-hourglass-split.spin {
                    animation: spin 1s linear infinite;
                }
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                
                .is-valid {
                    border-color: #4ade80 !important;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>