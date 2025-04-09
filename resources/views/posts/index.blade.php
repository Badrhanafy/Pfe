<!-- resources/views/posts/index.blade.php -->
@extends('layouts.master')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Post creation form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form id="post-form">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="3" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
            
            <!-- Posts list -->
            <div id="posts-container">
                @foreach($posts as $post)
                    @include('posts.partials.post', ['post' => $post])
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
// In your Blade template's script section
<script>
    // Initialize Pusher
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        encrypted: true
    });

    // Subscribe to channels
    const postsChannel = pusher.subscribe('posts');
    
    // Listen for new posts
    postsChannel.bind('App\\Events\\NewPostEvent', function(data) {
        // Prepend new post to the container
        $('#posts-container').prepend(data.post);
    });

    // For existing posts, subscribe to their channels
    @foreach($posts as $post)
        const postChannel{{ $post->id }} = pusher.subscribe('post.{{ $post->id }}');
        
        postChannel{{ $post->id }}.bind('new.comment', function(data) {
            // Append new comment
            const commentHtml = `
                <div class="d-flex mb-2">
                    <img src="${data.comment.user.profile_photo ? '/storage/' + data.comment.user.profile_photo : '/images/default-profile.png'}" 
                         class="rounded-circle mr-2" width="30" height="30">
                    <div>
                        <strong>${data.comment.user.name}</strong>
                        <p class="mb-0">${data.comment.content}</p>
                        <small class="text-muted">Just now</small>
                    </div>
                </div>
            `;
            $('#post-{{ $post->id }}-comments').append(commentHtml);
        });
        
        postChannel{{ $post->id }}.bind('reaction.updated', function(data) {
            // Update reaction buttons
            $('#post-{{ $post->id }} .like-btn').text(`Like (${data.post.like_count})`);
            $('#post-{{ $post->id }} .dislike-btn').text(`Dislike (${data.post.dislike_count})`);
        });
    @endforeach
</script>
@endpush