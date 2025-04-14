@extends('layouts.master')

@section('main')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New Post</h1>
        
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
                <textarea name="content" id="content" rows="6" 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required></textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image (Optional)</label>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="file" name="image" id="image" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               accept="image/*">
                        <label for="image" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg cursor-pointer transition duration-200">
                            Choose File
                        </label>
                    </div>
                    <span id="file-name" class="text-gray-500">No file chosen</span>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('posts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                    Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endsection