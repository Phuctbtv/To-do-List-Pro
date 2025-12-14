<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Todo List Pro</title>
    
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
            --success-color: #4ade80;
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
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }
        
        .register-card:hover {
            transform: translateY(-5px);
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .register-header::before {
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
        
        .register-header h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
            position: relative;
        }
        
        .register-header p {
            opacity: 0.9;
            font-size: 0.95rem;
            position: relative;
        }
        
        .register-body {
            padding: 40px 30px;
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
        
        .form-control-custom.has-success {
            border-color: var(--success-color);
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
        
        .success-message {
            color: var(--success-color);
            font-size: 0.875rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }
        
        .password-strength {
            margin-top: 10px;
        }
        
        .strength-bar {
            height: 5px;
            background: #e9ecef;
            border-radius: 3px;
            margin-bottom: 5px;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .strength-text {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .register-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 0.9rem;
        }
        
        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-footer a:hover {
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
        
        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 25px;
            font-size: 0.9rem;
            color: #555;
        }
        
        .terms-checkbox input[type="checkbox"] {
            margin-top: 3px;
        }
        
        .terms-checkbox a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .terms-checkbox a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            .register-card {
                max-width: 100%;
            }
            
            .register-header,
            .register-body {
                padding: 30px 20px;
            }
            
            .register-header h1 {
                font-size: 1.75rem;
            }
        }
        
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 42px;
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            z-index: 2;
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
        
        .step-indicator {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
        }
        
        .step {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
        }
        
        .step.active {
            background: white;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <!-- Header -->
        <div class="register-header">
            <div class="step-indicator">
                <div class="step active"></div>
                <div class="step"></div>
                <div class="step"></div>
            </div>
            <div class="logo-container">
                <i class="bi bi-check2-square logo-icon"></i>
                <h1>Create Account</h1>
            </div>
            <p>Join Todo List Pro to boost your productivity</p>
        </div>
        
        <!-- Body -->
        <div class="register-body">
            <!-- Error Alert -->
            @if($errors->any())
                <div class="alert-message alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        <strong>Registration failed!</strong> Please fix the following errors:
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <!-- Name -->
                <div class="form-group">
                    <label class="form-label" for="name">
                        <i class="bi bi-person me-2"></i>Full Name
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        class="form-control-custom {{ $errors->has('name') ? 'has-error' : '' }}"
                        placeholder="Enter your full name">
                    <i class="bi bi-person input-icon"></i>
                    
                    @error('name')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Email -->
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
                        autocomplete="email"
                        class="form-control-custom {{ $errors->has('email') ? 'has-error' : '' }}"
                        placeholder="Enter your email">
                    <i class="bi bi-envelope input-icon"></i>
                    
                    @error('email')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="bi bi-lock me-2"></i>Password
                    </label>
                    <div class="password-field">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="form-control-custom {{ $errors->has('password') ? 'has-error' : '' }}"
                            placeholder="Create a strong password"
                            oninput="checkPasswordStrength(this.value)">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    
                    <!-- Password Strength Meter -->
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength</div>
                    </div>
                    
                    @error('password')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">
                        <i class="bi bi-lock-fill me-2"></i>Confirm Password
                    </label>
                    <div class="password-field">
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="form-control-custom {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"
                            placeholder="Confirm your password"
                            oninput="checkPasswordMatch()">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    
                    <div class="success-message" id="passwordMatchMessage" style="display: none;">
                        <i class="bi bi-check-circle"></i>
                        Passwords match
                    </div>
                    
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Terms and Conditions -->
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-register" id="submitBtn">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </button>
            </form>
            
            <!-- Footer -->
            <div class="register-footer">
                Already have an account? 
                <a href="{{ route('login') }}">Sign in here</a>
                <br>
                <a href="{{ url('/') }}">← Back to Homepage</a>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = passwordField.nextElementSibling.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
        
        // Check password strength
        function checkPasswordStrength(password) {
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let text = '';
            let color = '';
            
            // Check password length
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;
            
            // Check for special characters
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 25;
            
            // Check for numbers and letters
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
            if (/\d/.test(password)) strength += 25;
            
            // Cap at 100
            strength = Math.min(strength, 100);
            
            // Set color and text based on strength
            if (strength < 40) {
                color = '#dc3545';
                text = 'Weak password';
            } else if (strength < 70) {
                color = '#ffc107';
                text = 'Medium password';
            } else {
                color = '#4ade80';
                text = 'Strong password';
            }
            
            // Update UI
            strengthFill.style.width = strength + '%';
            strengthFill.style.background = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        }
        
        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const message = document.getElementById('passwordMatchMessage');
            
            if (confirmPassword === '') {
                message.style.display = 'none';
                return;
            }
            
            if (password === confirmPassword) {
                message.style.display = 'flex';
                document.getElementById('password_confirmation').classList.remove('has-error');
                document.getElementById('password_confirmation').classList.add('has-success');
            } else {
                message.style.display = 'none';
                document.getElementById('password_confirmation').classList.add('has-error');
                document.getElementById('password_confirmation').classList.remove('has-success');
            }
        }
        
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
            
            // Check initial password match
            checkPasswordMatch();
            
            // Check initial password strength
            const initialPassword = document.getElementById('password').value;
            if (initialPassword) {
                checkPasswordStrength(initialPassword);
            }
        });
        
        // Form submission validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;
            
            if (!terms) {
                e.preventDefault();
                alert('Please agree to the Terms of Service and Privacy Policy.');
                return;
            }
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match. Please check your password confirmation.');
                return;
            }
            
            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Creating Account...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>