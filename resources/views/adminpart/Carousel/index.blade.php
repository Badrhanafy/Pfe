@extends('layouts.admin')
@section('adminWorld')
<script src="//unpkg.com/alpinejs" defer></script>
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<div class="min-h-screen bg-gray-50 font-sans">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-toggle" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-lg">
        <i class="fas fa-bars text-indigo-600"></i>
    </button>

    <!-- Sidebar -->
<aside
class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-indigo-300 to-purple-400 text-gray-900 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col h-screen">
<!-- Header -->
<div class="flex-shrink-0 flex items-center justify-center h-16 bg-indigo-400">
    <span class="text-xl font-bold tracking-tight">Admin Panel</span>
</div>

<!-- Scrollable Navigation -->
<nav class="flex-1 overflow-y-auto">
    <ul class="space-y-2 p-4">
        <li>
            <a href="{{ route('Admindashboard') }}"
                class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('users') }}"
                class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                <i class="fa-solid fa-users-gear mr-3"></i> Manage Users
            </a>
        </li>
        <li>
            <a href="{{ route('Artisans') }}"
                class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                <i class="fa-solid fa-briefcase mr-3"></i>Manage Artisans
            </a>
        </li>
        <li>
            <a href="{{ route('AllPosts') }}"
                class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                <i class="fa-solid fa-image mr-3"></i> Manage Posts
            </a>
        </li>
        
        <!-- Add more list items as needed -->
    </ul>
</nav>

<!-- Fixed Footer -->
<div class="flex-shrink-0 p-4 border-t border-indigo-300 bg-indigo-100">
    <div class="flex items-center justify-between relative group">
        <!-- Profile Section -->
        <div class="flex items-center space-x-3">
            
                <img class="h-12 w-12 rounded-full border-2 border-indigo-500"
                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                alt="User Avatar">
            
            <div>
                <p class="text-sm font-semibold text-indigo-800 truncate">{{ Auth::user()->email }}</p>
                <p class="text-xs text-gray-500">Admin</p>
            </div>
        </div>

        <!-- Animated Logout Button -->
        <form action="{{ route('logout') }}" method="post" 
            class="opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
            @csrf
            <button type="submit"
                    class="p-2 bg-red-500 hover:bg-red-600 rounded-full shadow-lg text-white transition-all duration-300 transform hover:scale-110 relative group/button">
                <i class="fas fa-sign-out-alt text-sm"></i>
                <!-- Tooltip -->
                <span class="absolute -top-8 right-0 bg-gray-800 text-white text-xs px-2 py-1 rounded-md opacity-0 group-hover/button:opacity-100 transition-opacity duration-300
                            after:content-[''] after:absolute after:top-full after:right-2 after:border-4 after:border-transparent after:border-t-gray-800">
                    Logout
                </span>
            </button>
        </form>
    </div>
</div>
</aside>
    

    <!-- Main Content -->
    <main class="md:ml-64 transition-all duration-300">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm  sticky top-0" style="background-position: stiky">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex-1 max-w-xs">
                        <h1 class="text-blue-500 text-bold shadow-md hover:shadow-lg"
                           style="font-weight: bolder"
                        >Customize your carousel Slides !</h1>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <a href="{{ route('settingsHome') }}">
                        <div class="flex items-center gap-2">
                            <img class="h-12 w-42" 
                                 src="http://127.0.0.1:8000/images/logo.png" 
                                 alt="User avatar">
                            
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Carousel Images</h2>
                <a href="{{ route('admin.carousels.create') }}" class="btn btn-primary">+ Add New Image</a>
            </div>
        
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            <div x-data="{ show: false , imgSrc: '' }">
                <div class="row">
                    @forelse($carousels as $carousel)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm hover:shadow-lg transition">
                                <img 
                                    src="{{ asset($carousel->image) }}" 
                                    class="card-img-top cursor-pointer transition hover:scale-105 duration-300 ease-in-out" 
                                    alt="Carousel Image" 
                                    style="height: 200px; object-fit: cover;"
                                    @click="imgSrc = '{{ asset($carousel->image) }}'; show = true"
                                >
                                <div class="card-body">
                                    <h5 class="card-title">{{ $carousel->title }}</h5>
                                    <a href="{{ route('admin.carousels.edit', $carousel->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">No carousel images found.</div>
                        </div>
                    @endforelse
                </div>
            
                <!-- Modal -->
                <div 
                    x-show="show" 
                    x-transition 
                    class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                    @click.away="show = false"
                >
                    <img 
                        :src="imgSrc" 
                        class="max-w-4xl max-h-[90vh] rounded shadow-lg transition-transform duration-300 transform scale-95 hover:scale-100"
                    >
                    <button 
                        class="absolute top-5 right-5 text-white text-3xl font-bold hover:text-red-400" @click="show = false"
                    >&times;</button>
                </div>
            </div>
            
        </div>
    </main>
</div>

@push('scripts')
<script>


   

    

</script>
@endpush
@endsection
