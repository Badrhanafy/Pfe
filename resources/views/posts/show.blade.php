@extends('layouts.master')

@section('main')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full h-96 object-cover">
            @endif
            
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $post->title }}</h1>
                        <p class="text-gray-600 whitespace-pre-line">{{ $post->content }}</p>
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
                
                <div class="flex items-center text-sm text-gray-500 mt-4">
                    <img src="{{ $post->user->progilePhoto ? asset('storage/photos/'. $post->user->progilePhoto) : asset('images/avatar.avif') }}" 
                         alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full mr-2">
                    <span>{{ $post->user->name }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center space-x-4 border-t border-b border-gray-100 py-3 my-4">
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
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Comments ({{ $post->comments->count() }})</h2>
            
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
                @csrf
                <div class="flex space-x-2">
                    <img src="{{ Auth::user()->progilePhoto ? asset('storage/photos/'.Auth::user()->progilePhoto) : asset('images/default-avatar.png') }}" 
                         alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <input type="text" name="content" placeholder="Write a comment..." 
                               class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </form>
            
            <div class="space-y-4">
                @forelse ($post->comments as $comment)
                    <div class="flex space-x-3">
                        <img src="{{ $comment->user->progilePhoto ? asset('storage/photos/'. $post->user->progilePhoto) : asset('images/default-avatar.png') }}" 
                             alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex justify-between items-center mb-1">
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
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection