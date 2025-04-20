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
        <div class="max-w-3xl mx-auto px-6 py-8 bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Edit Carousel</h2>
                <a href="{{ route('admin.carousels.index') }}" class="text-sm text-blue-600 hover:underline">← Back to List</a>
            </div>
        
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
        
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <form action="{{ route('admin.carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
        
                <div>
                    <label for="title" class="block font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ $carousel->title }}" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
        
                <div>
                    <label for="description" class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $carousel->description }}</textarea>
                </div>
        
                <div>
                    <label for="image" class="block font-medium text-gray-700">Upload New Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-600">
                </div>
        
                <div>
                    <p class="font-medium text-gray-700 mb-2">Current Image:</p>
                    <img src="{{ asset($carousel->image) }}" alt="Current Carousel Image" class="w-52 h-auto rounded shadow" name="image">
                    @error("image")
                        <p class="text-danger">{{ $message}}</p>
                    @enderror
                </div>
        
                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-all">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

@push('scripts')
<script>


   

    

</script>
@endpush
@endsection
