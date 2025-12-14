<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Todo List Pro</title>
    
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
            --accent-color: #4cc9f0;
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
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .login-header h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .login-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .login-body {
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
        
        .btn-login {
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
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #555;
        }
        
        .custom-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
        }
        
        .custom-checkbox input {
            display: none;
        }
        
        .custom-checkbox .checkmark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--primary-color);
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .custom-checkbox input:checked + .checkmark {
            opacity: 1;
        }
        
        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 0.9rem;
        }
        
        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-footer a:hover {
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
            .login-card {
                max-width: 100%;
            }
            
            .login-header,
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header h1 {
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
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .logo-icon {
            font-size: 2.5rem;
            color: white;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="logo-container">
                <i class="bi bi-check2-square logo-icon"></i>
                <h1>Todo List Pro</h1>
            </div>
            <p>Sign in to manage your tasks efficiently</p>
        </div>
        
        <!-- Body -->
        <div class="login-body">
            <!-- Session Status -->
            @if(session('status'))
                <div class="alert-message alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Error Alert -->
            @if($errors->any())
                <div class="alert-message alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        <strong>Oops!</strong> Please check the following errors:
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
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
                        autofocus 
                        autocomplete="username"
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
                            autocomplete="current-password"
                            class="form-control-custom {{ $errors->has('password') ? 'has-error' : '' }}"
                            placeholder="Enter your password">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    
                    @error('password')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <label class="remember-me">
                        <span class="custom-checkbox">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="checkmark">
                                <i class="bi bi-check"></i>
                            </span>
                        </span>
                        Remember me
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
            </form>
            
            <!-- Footer -->
            <div class="login-footer">
                Don't have an account? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Create account</a>
                @endif
                <br>
                <a href="{{ url('/') }}">← Back to Homepage</a>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');
            
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
        });
        
        // Form validation styling
        const inputs = document.querySelectorAll('.form-control-custom');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });
        });
    </script>
</body>
</html>