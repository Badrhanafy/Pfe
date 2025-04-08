@extends('layouts.master')

@section('main')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <small>Published on {{ $post->created_at->format('M d, Y') }}</small>
    
    @if ($post->image)
        <img src="{{ asset('images/'.$post->image) }}" class="img-fluid rounded mb-2" style="max-width: 100%; height: auto;">
    @endif

    <div class="mt-3">
        <p>{{ $post->content }}</p>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <div>
            <button class="btn btn-success" id="like-button">Like <span id="like-count">{{ $post->likes_count }}</span></button>
            <button class="btn btn-danger" id="dislike-button">Dislike <span id="dislike-count">{{ $post->dislikes_count }}</span></button>
        </div>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
    </div>

    <hr>

    <h3>Comments</h3>
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" placeholder="Leave a comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>

    <div class="comments-section">
        @foreach($post->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    <small>Commented on {{ $comment->created_at->format('M d, Y') }}</small>
                </div>
            </div>
        @endforeach
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('like-button').addEventListener('click', function() {
        // Implement AJAX request to like the post
        // Update the like count dynamically
    });

    document.getElementById('dislike-button').addEventListener('click', function() {
        // Implement AJAX request to dislike the post
        // Update the dislike count dynamically
    });
</script>
@endsection
@endsection