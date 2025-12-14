<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Pro</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Figtree', sans-serif;
        }
        .card {
            border-radius: 12px;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        .nav-link-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #333;
        }
        .nav-link-item:hover {
            color: #0d6efd;
        }
        .mobile-menu {
            display: none;
        }
        @media (max-width: 767.98px) {
            .desktop-menu {
                display: none !important;
            }
            .mobile-menu {
                display: block;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm py-2">
        <div class="container-fluid">
            <!-- Logo và menu desktop -->
            <div class="d-flex align-items-center w-100">
                <!-- Logo -->
                <a class="navbar-brand text-primary me-4" href="{{ url('/') }}">
                    <i class="bi bi-check2-square me-2"></i>Todo List Pro
                </a>

                <!-- Menu desktop -->
                <div class="desktop-menu d-flex align-items-center flex-grow-1">
                    <a class="nav-link-item me-3" href="{{ route('tasks.index') }}">
                        <i class="bi bi-list-task me-1"></i>Danh sách
                    </a>
                    <a class="nav-link-item me-3" href="{{ route('tasks.create') }}">
                        <i class="bi bi-plus-circle me-1"></i>Thêm Task
                    </a>
                </div>

                <!-- Auth buttons -->
                <div class="d-flex align-items-center">
                    @guest
                        @if (Route::has('login'))
                            <a class="btn btn-outline-primary btn-sm me-2" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Đăng nhập
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>Đăng ký
                            </a>
                        @endif
                    @else
                        <!-- User dropdown -->
                        <div class="dropdown">
                            <button class="btn p-0 dropdown-toggle d-flex align-items-center" 
                                    type="button" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <div class="user-avatar me-2">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="fw-medium me-1">{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down text-muted"></i>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i>Hồ sơ
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i>Cài đặt
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger w-100 text-start border-0 bg-transparent">
                                            <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile menu -->
    <div class="mobile-menu container-fluid py-2 border-top bg-white">
        <div class="container">
            <div class="d-flex justify-content-around">
                <a class="btn btn-outline-primary btn-sm flex-fill mx-1" href="{{ route('tasks.index') }}">
                    <i class="bi bi-list-task me-1"></i>Danh sách
                </a>
                <a class="btn btn-primary btn-sm flex-fill mx-1" href="{{ route('tasks.create') }}">
                    <i class="bi bi-plus-circle me-1"></i>Thêm Task
                </a>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <main class="container py-4">
        <!-- Alert messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <strong>Thành công!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <strong>Lỗi!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('status'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
    
    @stack('scripts')
</body>
</html>