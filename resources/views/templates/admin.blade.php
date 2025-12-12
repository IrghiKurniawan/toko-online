<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #002455 0%, #1B3C53 100%);
            padding: 0;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 4px 0 12px rgba(0, 36, 85, 0.15);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 213, 79, 0.1) 100%);
            border-bottom: 2px solid rgba(255, 193, 7, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #002455;
            font-size: 1.5rem;
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
            flex-shrink: 0;
        }

        .brand-text {
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .brand-text {
            opacity: 0;
            display: none;
        }

        .toggle-btn {
            background-color: transparent;
            border: 2px solid rgba(255, 193, 7, 0.3);
            color: #FFC107;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background-color: #FFC107;
            color: #002455;
            border-color: #FFC107;
        }

        /* User Profile */
        .user-profile {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #002455;
            font-size: 1.25rem;
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
            flex-shrink: 0;
        }

        .user-info {
            flex-grow: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .user-info {
            opacity: 0;
            display: none;
        }

        .user-name {
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .user-role {
            color: #FFC107;
            font-size: 0.875rem;
        }

        /* Navigation Menu */
        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1.5rem 0.5rem;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
            display: none;
        }

        .nav-item {
            margin: 0.25rem 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            position: relative;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.25rem;
            text-align: center;
            color: #FFC107;
            flex-shrink: 0;
        }

        .nav-link span {
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
            display: none;
        }

        .nav-link:hover {
            background-color: rgba(255, 193, 7, 0.15);
            color: #FFC107;
            transform: translateX(5px);
        }

        .nav-link:hover i {
            transform: scale(1.1);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.2) 0%, rgba(255, 213, 79, 0.2) 100%);
            color: #FFC107;
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.2);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 70%;
            background-color: #FFC107;
            border-radius: 0 4px 4px 0;
        }

        /* Logout Section */
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            background-color: transparent;
            border: 2px solid rgba(255, 193, 7, 0.3);
            color: #FFC107;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
        }

        .logout-btn i {
            width: 24px;
            font-size: 1.25rem;
            text-align: center;
            flex-shrink: 0;
        }

        .logout-btn span {
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logout-btn span {
            opacity: 0;
            display: none;
        }

        .logout-btn:hover {
            background-color: #FFC107;
            color: #002455;
            border-color: #FFC107;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        /* Top Navbar */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 70px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .sidebar.collapsed~.top-navbar {
            left: 80px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #002455;
            margin: 0;
        }

        .navbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar-icon-btn {
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #002455;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-icon-btn:hover {
            background-color: #002455;
            color: #fff;
            transform: translateY(-2px);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            background-color: #dc3545;
            color: #fff;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 80px;
        }

        /* Mobile Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .top-navbar {
                left: 0 !important;
            }

            .main-content {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: flex !important;
            }
        }

        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            border: none;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            color: #002455;
            margin-right: 1rem;
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 193, 7, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 193, 7, 0.5);
        }
    </style>

    @stack('style')
</head>

<body>
    {{-- Sidebar Overlay for Mobile --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        {{-- Sidebar Header --}}
        <div class="sidebar-header">
            <div class="brand-wrapper">
                <button class="toggle-btn" id="toggleSidebar">
                    <i class="fas fa-angles-left"></i>
                </button>
                <span class="brand-text">Admin Panel</span>
            </div>
        </div>

        {{-- User Profile --}}
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-info">
                <div class="user-name">Administrator</div>
                <div class="user-role">Admin</div>
            </div>
        </div>

        {{-- Navigation Menu --}}
        <nav class="sidebar-nav">
            <div class="nav-section-title">Main Menu</div>

            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="nav-section-title">Management</div>

            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.category*') ? 'active' : '' }}"
                    href="{{ route('admin.category') }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Categories</span>
                </a>
            </div>

            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.product*') ? 'active' : '' }}"
                    href="{{ route('admin.product') }}">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </div>

            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}"
                    href="{{ route('admin.orders') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </div>

            <div class="nav-section-title">Settings</div>

            <div class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.admin.account*') ? 'active' : '' }}"
                    href="{{ route('admin.admin.account.data') }}">
                    <i class="fas fa-user-cog"></i>
                    <span>Account</span>
                </a>
            </div>
        </nav>

        {{-- Logout --}}
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        @yield('content-admin')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script>
        // Toggle Sidebar
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const toggleIcon = toggleBtn.querySelector('i');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('fa-angles-left');
                toggleIcon.classList.add('fa-angles-right');
            } else {
                toggleIcon.classList.remove('fa-angles-right');
                toggleIcon.classList.add('fa-angles-left');
            }

            // Save state to localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });

        // Load saved state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
            toggleIcon.classList.remove('fa-angles-left');
            toggleIcon.classList.add('fa-angles-right');
        }

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileMenuBtn.addEventListener('click', function () {
            sidebar.classList.add('show');
            sidebarOverlay.classList.add('show');
        });

        sidebarOverlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });

        // Close sidebar when clicking nav link on mobile
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });
        });
    </script>

    @stack('script')
</body>

</html>