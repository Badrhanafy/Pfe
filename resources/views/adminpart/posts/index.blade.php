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
        <header class="bg-white shadow-sm sticky top-0">
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

        <!-- Posts Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Manage Posts</h2>
                <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create New Post
                </a>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="Post image" 
                             class="w-full h-48 object-cover">
                        
                        <!-- Content Overlay -->
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-4 overflow-y-auto">
                            <p class="text-white text-sm leading-relaxed line-clamp-6">
                                {{ $post->content }}
                            </p>
                        </div>
            
                        <!-- Delete Button -->
                       <form action="{{ route('removePost',$post->id) }}" method="post">
                          @method("DELETE")
                          @csrf
                          <button 
                          class="absolute top-2 right-2 p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors delete-post z-10"
                          type="submit"
                          data-post-title="{{ $post->title }}">
                          <i class="fas fa-trash text-sm"></i>
                         </button>
                       </form>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 mb-2 truncate">{{ $post->title }}</h3>
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle mr-2 text-indigo-500"></i>
                                {{ $post->user->name }}
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="inline-flex items-center px-2 py-1 bg-gray-100 rounded">
                                <i class="fas fa-comment mr-2 text-indigo-500"></i>
                                {{ $post->comments_count }} comments
                            </span>
                            <span class="inline-flex items-center px-2 py-1 bg-gray-100 rounded">
                                <i class="fas fa-heart mr-2 text-red-500"></i>
                                {{ $post->likes_count }} likes
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($posts->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-500 text-xl mb-4">
                    <i class="fas fa-box-open text-4xl mb-4"></i>
                    <p>No posts found.</p>
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Delete Post</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete "<span id="postTitle" class="font-semibold"></span>"?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDelete" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        Delete Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Delete Post Modal Logic
    const deleteButtons = document.querySelectorAll('.delete-post');
    const deleteModal = document.getElementById('deleteModal');
    const postTitleSpan = document.getElementById('postTitle');
    const deleteForm = document.getElementById('deleteForm');
    const cancelDelete = document.getElementById('cancelDelete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const postTitle = this.getAttribute('data-post-title');
            
            postTitleSpan.textContent = postTitle;
            deleteForm.action = `/admin/posts/${postId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    cancelDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });

    window.addEventListener('click', (event) => {
        if (event.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });
});
</script>
@endpush

@endsection