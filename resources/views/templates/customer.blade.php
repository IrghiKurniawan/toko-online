<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Online - {{ config('app.name', 'Shop') }}</title>
    
    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .custom-navbar {
            background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
            box-shadow: 0 4px 12px rgba(0,36,85,0.15);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .custom-navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 6px 20px rgba(0,36,85,0.25);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #002455;
            font-size: 1.25rem;
            box-shadow: 0 4px 8px rgba(255,193,7,0.3);
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 600;
            padding: 0.5rem 1.25rem !important;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background-color: #FFC107;
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover {
            color: #FFC107 !important;
            background-color: rgba(255,193,7,0.1);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .nav-link.active {
            color: #FFC107 !important;
            background-color: rgba(255,193,7,0.15);
        }

        .nav-link.active::before {
            width: 80%;
        }

        /* Cart Badge */
        .cart-link {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #FFC107;
            color: #002455;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            min-width: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* User Dropdown */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #002455;
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(255,193,7,0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(255,193,7,0.4);
        }

        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,36,85,0.15);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #002455;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(0,36,85,0.1) 0%, rgba(27,60,83,0.1) 100%);
            color: #002455;
            transform: translateX(5px);
        }

        .dropdown-item i {
            width: 20px;
            color: #FFC107;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(0,36,85,0.1);
        }

        /* Logout Button */
        .btn-logout {
            background-color: transparent;
            border: 2px solid rgba(255,255,255,0.3);
            color: #fff;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #FFC107;
            border-color: #FFC107;
            color: #002455;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255,193,7,0.3);
        }

        /* Mobile Toggle */
        .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.3);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background-color: rgba(255,193,7,0.1);
            border-color: #FFC107;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }

        /* Footer */
        footer {
            margin-top: auto;
            background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
            color: #fff;
            padding: 2rem 0 1rem;
        }

        .footer-content {
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .footer-link {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: #FFC107;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: #FFC107;
            color: #002455;
            transform: translateY(-3px);
        }

        .copyright {
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        /* Content Wrapper */
        .content-wrapper {
            flex: 1;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-collapse {
                margin-top: 1rem;
                padding: 1rem;
                background-color: rgba(255,255,255,0.05);
                border-radius: 12px;
            }

            .nav-link {
                margin: 0.25rem 0;
            }

            .user-menu {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .btn-logout {
                width: 100%;
                margin-top: 0.5rem;
            }
        }

        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
            color: #002455;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(255,193,7,0.4);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(255,193,7,0.5);
        }
    </style>
    
    @stack('style')
</head>

<body>
    @if (auth()->check())
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div class="brand-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <span>Toko Online</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('customer.index') || request()->routeIs('customer.product') ? 'active' : '' }}" 
                               href="{{ route('customer.product') }}">
                                <i class="fas fa-box-open me-2"></i>Produk
                            </a>
                        </li>
                    </ul>
                    <div class="user-menu">

                        {{-- Logout Button (Desktop) --}}
                        <form action="{{ route('customer.logout') }}" method="POST" class="d-none d-lg-block">
                            @csrf
                            <button type="submit" class="btn btn-logout">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    @endif

    {{-- Content Wrapper --}}
    <div class="content-wrapper">
        @yield('content-customer')
    </div>

    {{-- Footer --}}
    <footer>
        {{-- <div class="container">
            <div class="footer-content">
                <div class="footer-links">
                    <a href="#" class="footer-link">Tentang Kami</a>
                    <a href="#" class="footer-link">Hubungi Kami</a>
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <a href="#" class="footer-link">Syarat & Ketentuan</a>
                </div>
                
                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>

                <p class="copyright">
                    &copy; 2024 Toko Online. All rights reserved.
                </p>
            </div>
        </div> --}}
    </footer>

    {{-- Scroll to Top Button --}}
    <button class="scroll-top" id="scrollTopBtn">
        <i class="fas fa-arrow-up"></i>
    </button>

    {{-- CDN Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.custom-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Auto close navbar on mobile after click
        const navLinks = document.querySelectorAll('.nav-link');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: false
                    });
                    bsCollapse.hide();
                }
            });
        });
    </script>

    @stack('script')
</body>

</html>