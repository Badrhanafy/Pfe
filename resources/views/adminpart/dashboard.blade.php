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
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stats Cards with hover effects -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 rounded-lg">
                            <i class="fas fa-file-alt text-indigo-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Total Posts</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $posts->count() }}</p>
                        </div>
                        
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 rounded-lg">
                           
                            <i class="fa-solid fa-comments text-indigo-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Total Comments</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $comments->count() }}</p>
                        </div>
                        
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 rounded-lg">
                            <i class="fa-solid fa-users text-indigo-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $users->count() }}</p>
                        </div>
                        
                    </div>
                </div>
                <!-- Repeat for other stats cards -->
            </div>
             
            <!-- Enhanced Chart Section -->
            <div class="bg-white p-6 rounded-xl shadow-sm mb-8 " style="">
                <h2 class="text-bold text-2xl text-indigo-600">Growth </h2>
                <div style="width: 80%; margin: auto;">
                    <h2 style="text-align: center;">User Growth (Jan - Dec)</h2>
                    <canvas id="userGrowthChart"></canvas>
                </div>
                
                <script>
                    const labels = {!! json_encode($labels) !!};
                    const data1 = {!! json_encode($data) !!};
                    const data2 = [2, 4, 8, 12, 6, 10, 15, 7, 3, 9, 11, 13]; // optional: second curve
                
                    const ctx = document.getElementById('userGrowthChart').getContext('2d');
                    const userGrowthChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'New Users (2025)',
                                    data: data1,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4
                                },
                                {
                                    label: 'Last Year (Demo)',
                                    data: data2,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 3,
                                    fill: true,
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
                
                <div class="relative h-96">
                    <canvas id="userGrowthChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Activity & Actions Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @foreach($recentPosts as $post)
                        <div class="flex items-start p-4 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-file-alt text-indigo-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $post->title }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="font-medium">{{ $post->user->name }}</span>
                                    <span class="text-xs text-gray-400 ml-2">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Actions Panel -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 gap-3">
                        <a href="#" class="p-4 rounded-lg bg-indigo-50 hover:bg-indigo-100 transition-colors flex items-center">
                            <i class="fas fa-plus-circle mr-3 text-indigo-600"></i>
                            <span>Create New Post</span>
                        </a>
                        <a href="#" class="p-4 rounded-lg bg-green-50 hover:bg-green-100 transition-colors flex items-center">
                            <i class="fas fa-user-plus mr-3 text-green-600"></i>
                            <span>Add New User</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
    const labels = {!! json_encode($labels) !!};
    const data1 = {!! json_encode($data) !!};
    const data2 = [2, 4, 8, 12, 6, 10, 15, 7, 3, 9, 11, 13];

    const ctx = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'New Users (2025)',
                    data: data1,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Last Year (Demo)',
                    data: data2,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endpush
@endsection