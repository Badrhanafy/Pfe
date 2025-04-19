@extends('layouts.admin')
@section('adminWorld')

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<div class="min-h-screen bg-gray-50 font-sans">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-toggle" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-lg">
        <i class="fas fa-bars text-indigo-600"></i>
    </button>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-indigo-300 to-purple-400 text-gray-900 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-center h-16 bg-indigo-400">
            <span class="text-xl font-bold tracking-tight">Admin Panel</span>
        </div>
        
        <nav class="flex-grow p-4 overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('Admindashboard') }}" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('users') }}" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fa-solid fa-users-gear mr-3"></i> Manage Users
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fa-solid fa-image mr-3"></i> Manage Posts
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fa-solid fa-comment mr-3"></i> Manage Comments
                    </a>
                </li>
            </ul>
        </nav>
    
        <!-- User Profile Footer -->
        <div class="p-4 border-t border-indigo-300 bg-indigo-100 fixed bottom-0 w-64">
            <div class="flex items-center space-x-3">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="">
                <div>
                    <p class="text-sm font-medium truncate">{{ Auth::user()->email }}</p>
                    <p class="text-xs text-gray-600">Admin</p>
                </div>
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
                        <div class="relative">
                            <input type="text" placeholder="Search..." 
                                   class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        
                        <div class="flex items-center gap-2">
                            <img class="h-12 w-42" 
                                 src="http://127.0.0.1:8000/images/logo.png" 
                                 alt="User avatar">
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
    </main>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu Toggle
    const sidebar = document.querySelector('aside');
    document.getElementById('mobile-menu-toggle').addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && 
            !document.getElementById('mobile-menu-toggle').contains(e.target) &&
            window.innerWidth < 768) {
            sidebar.classList.add('-translate-x-full');
        }
    });

    // Keep original chart logic unchanged
    

    
})
</script>
@endpush
@endsection