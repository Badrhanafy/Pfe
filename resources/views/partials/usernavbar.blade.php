<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #e3e3eb;
            --secondary-color: #27237b;
            --accent-color: #94b5da;
            --text-color: #806c6c;
            --light-bg: #a2b3c5;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        /* Navbar Container */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 70px; /* Fixed navbar height */
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            padding: 0 2rem;
            gap: 1rem;
        }

        /* Brand Logo - Takes full height */
        .brand-container {
            height: 100%;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .brand-icon {
            height: 100%;
            padding: 5px 0;
            object-fit: civer;
            width: 100vh;
            max-width: 200px;
            transition: all 0.3s ease;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Main Navigation Area */
        .nav-main {
            display: flex;
            align-items: center;
            height: 100%;
            flex-grow: 1;
            justify-content: center;
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            height: auto;
            margin: 0 auto;
            margin-right: 5vh;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0 0.5rem;
            height: 100%;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: white;
            transition: width 0.3s ease;
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .nav-link i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: translateY(-3px);
        }

        /* Right Navigation Area */
        .nav-right {
            display: flex;
            align-items: center;
            height: 100%;
            gap: 1rem;
            flex-shrink: 0;
        }

        /* Auth Buttons */
        .nav-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-nav {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        /* Profile Dropdown */
        .profile-dropdown {
           
            position: relative;
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0 0.5rem;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid yellow;
            box-shadow: 1px 1px 5px 0px  gold ;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .dropdown-content {
            background-color: rgb(77,74,146)    ;
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
           
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
            z-index: 1;
            overflow: hidden;
        }

        .dropdown-content a {
            color: var(--text-color);
            padding: 12px 16px;
            color:white;
            
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #ffffff;
            color:rgb(77,74,146);
            padding-left: 20px;
        }

        .dropdown-content a i {
            margin-right: 10px;
            color: var(--accent-color);
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            cursor: pointer;
        }

        .menu-toggle span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: white;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 70%;
            height: 100vh;
            background-color: white;
            z-index: 1001;
            padding: 2rem;
            transition: right 0.3s ease;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu.active {
            right: 0;
        }

        .close-menu {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-color);
            cursor: pointer;
        }

        .mobile-nav-links {
            margin-top: 3rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mobile-nav-link {
            color: var(--text-color);
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .mobile-nav-link i {
            margin-right: 1rem;
            font-size: 1.5rem;
            color: var(--accent-color);
        }

        .mobile-nav-link:hover {
            transform: translateX(10px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .menu-toggle {
                display: flex;
            }

            .nav-main, .nav-right {
                display: none;
            }

            .mobile-menu {
                width: 80%;
            }
            
            .navbar-container {
                padding: 0 1rem;
            }
            
            .brand-icon {
                max-width: 160px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-container">
            <!-- Brand Container - Takes full height -->
            <div class="brand-container">
                <a href="{{ route('welcome') }}">
                    <img src="http://127.0.0.1:8000/images/logo.png" class="brand-icon" alt="Artisan Network Logo">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="nav-main">
                <!-- Navigation Links -->
                @auth
                <div class="nav-links">
                    <a class="nav-link" href="{{ route('artisans.index') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-users"></i> Network
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-plus-circle"></i> Create Post
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-bell"></i> Notifications
                    </a>
                </div>
                @endauth
            </div>

            <!-- Right Navigation Area -->
            <div class="nav-right">
                @guest
                <div class="nav-actions">
                    <button class="btn btn-outline-light btn-nav" id="openModalBtn">
                        <i class="fas fa-sign-in-alt me-1"></i> Join
                    </button>
                    
                </div>
                @endguest
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const btn = document.getElementById('openModalBtn');
                        btn?.addEventListener('click', function () {
                            const modal = new bootstrap.Modal(document.getElementById('profileTypeModal'));
                            modal.show();
                        });
                    });
                </script>
                @auth
                <div class="profile-dropdown">
                    <img src="{{ Auth::user()->progilePhoto ? asset('storage/photos/'.Auth::user()->progilePhoto) : asset('images/avatar-placeholder.png') }}" 
                         class="profile-img" 
                         alt="Profile Image">
                    <div class="dropdown-content">
                        <a href="{{ route('userProfile') }}">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                        <a href="#">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <hr>
                        <form action="{{ route('logout') }}" method="post" class="pb-2" >
                            @csrf
                            <center>
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </center>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <button class="close-menu" id="closeMenu">
                <i class="fas fa-times"></i>
            </button>
            <div class="mobile-nav-links">
                <a href="{{ route('welcome') }}" class="mobile-nav-link">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="#" class="mobile-nav-link">
                    <i class="fas fa-users"></i> Network
                </a>
                <a href="#" class="mobile-nav-link">
                    <i class="fas fa-plus-circle"></i> Create Post
                </a>
                <a href="#" class="mobile-nav-link">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                @auth
                <a href="{{ route('userProfile') }}" class="mobile-nav-link">
                    <i class="fas fa-user"></i> Profile
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="mobile-nav-link text-danger bg-transparent border-0 w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
                @endauth
                @guest
                <a href="{{ route('loginform') }}" class="mobile-nav-link">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}" class="mobile-nav-link">
                    <i class="fas fa-user-plus"></i> Register
                </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMenu = document.getElementById('closeMenu');

        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.add('active');
        });

        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>