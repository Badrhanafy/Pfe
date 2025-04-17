@extends('layouts.master')

@section('main')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Community Posts</h1>
        <a href="{{ route('userPosts') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
            My Posts
        </a>
        <a href="{{ route('posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
            Create Post
        </a>
    </div>
    

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        @forelse ($posts as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full h-64 object-cover">
                @endif
                
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $post->title }}</h2>
                            <p class="text-gray-600 mb-4">{{ $post->content }}</p>
                        </div>
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    </div>

                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <img src="{{ $post->user->progilePhoto ? asset('/storage/images' . $post->user->progilePhoto) : asset('images/default-avatar.png') }}" 
                             alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full mr-2">
                        <span>{{ $post->user->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="flex items-center space-x-4 border-t border-b border-gray-100 py-3 mb-4">
                        <form action="{{ route('reactions.store', $post) }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="like">
                            <button type="submit" class="flex items-center space-x-1 text-gray-500 hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $post->reactions->where('type', 'like')->count() }}</span>
                            </button>
                        </form>

                        <form action="{{ route('reactions.store', $post) }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="dislike">
                            <button type="submit" class="flex items-center space-x-1 text-gray-500 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 14.828a4 4 0 015.656 0L10 13.657l1.172 1.171a4 4 0 11-5.656 5.656L10 17.657l-6.828 6.828a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $post->reactions->where('type', 'dislike')->count() }}</span>
                            </button>
                        </form>

                        <a href="{{ route('posts.show', $post) }}" class="flex items-center space-x-1 text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $post->comments->count() }}</span>
                        </a>
                    </div>

                    <div class="mb-4">
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <div class="flex space-x-2">
                                <input type="text" name="content" placeholder="Write a comment..." 
                                       class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-200">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>

                    @if($post->comments->count() > 0)
                        <div class="space-y-3">
                            @foreach($post->comments->take(2) as $comment)
                                <div class="flex space-x-2">
                                    <img src="{{ $comment->user->profilePhoto ? asset('storage/' . $comment->user->profilePhoto) : asset('images/default-avatar.png') }}" 
                                         alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full">
                                    <div class="flex-1 bg-gray-50 rounded-lg p-3">
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium text-gray-800">{{ $comment->user->name }}</span>
                                            @can('delete', $comment)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                        <p class="text-gray-600">{{ $comment->content }}</p>
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach

                            @if($post->comments->count() > 2)
                                <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline text-sm">
                                    View all {{ $post->comments->count() }} comments
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-600">No posts yet. Be the first to create one!</p>
                <a href="{{ route('posts.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    Create Post
                </a>
            </div>
        @endforelse

        {{ $posts->links() }}
    </div>
</div>
@endsection