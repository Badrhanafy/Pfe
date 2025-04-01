<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Professional Navbar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
        <div class="container-fluid">
            <!-- Brand with icon -->
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-briefcase me-2 text-primary"></i>ProConnect
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left-aligned navigation items -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   @auth
                   <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('artisans.index') }}">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-users me-1"></i>Network
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-plus-circle me-1"></i>Create Post
                    </a>
                </li>
                   @endauth
                </ul>

                <!-- Right-aligned items -->
                <div class="d-flex align-items-center">
                    <!-- Search Form -->
                    @auth
                    <form class="d-flex me-3">
                      <div class="input-group">
                          <input type="search" class="form-control rounded-pill" 
                                 placeholder="Search..." aria-label="Search">
                          <button class="btn btn-link text-secondary" type="submit">
                              <i class="fas fa-search"></i>
                          </button>
                      </div>
                  </form>
                    @endauth

                    <!-- Profile Dropdown -->
                    @auth
                    <div class="dropdown">
                        <a class="btn btn-link text-decoration-none dropdown-toggle" 
                           href="#" role="button" id="profileDropdown" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                @if(Auth::check())  
                        <img src="{{ asset('storage/' . (Auth::user()->progilePhoto ?? 'images/avatar.jpg'))}}" alt="Profile Picture" width="40" height="40 "
                        class="rounded-circle me-2" 
                        alt="Profile" 
                        style="width: 32px; height: 32px;"
                        >
                        {{ Auth::user()->name }}
                    @else
                        Guest
                    @endif
                                
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" 
                            aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth

                    <!-- Guest Login Link -->
                    @guest
                    <a href="{{ route('loginform') }}" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .nav-link {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem !important;
        }

        .nav-link.active {
            background: rgba(13, 110, 253, 0.15);
            color: #0d6efd !important;
        }

        .dropdown-menu {
            min-width: 200px;
            border: 1px solid rgba(0,0,0,.1);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            padding-left: 1.25rem;
        }

        .navbar {
            padding: 0.5rem 1rem;
        }

        @media (min-width: 992px) {
            .dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        }
    </style>
</body>
</html>