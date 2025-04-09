<!-- resources/views/posts/partials/post.blade.php -->
<div class="card mb-4" id="post-{{ $post->id }}">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <img src="{{ $post->user->progilePhoto ? asset('storage/photos/'.$post->user->progilePhoto) : asset('images/avatar.avif') }}" 
                     class="rounded-circle mr-3" width="40" height="40">
                <h5 class="mb-0">{{ $post->user->name }}</h5>
            </div>
            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
        </div>
        
        <p class="card-text">{{ $post->content }}</p>
        
        @if($post->image)
            <img src="{{ asset('images/'.$post->image) }}" class="img-fluid mb-3">
        @endif
        
        <!-- Reactions -->
        <div class="d-flex mb-3" id="post-{{ $post->id }}-reactions">
            @php
                $userReaction = $post->reactions->where('user_id', auth()->id())->first();
                $likeCount = $post->reactions->where('type', 'like')->count();
                $dislikeCount = $post->reactions->where('type', 'dislike')->count();
            @endphp
            
            <button class="btn btn-sm like-btn" data-post-id="{{ $post->id }}" data-type="like">
                Like ({{ $post->like_count }})
            </button>
            <button class="btn btn-sm dislike-btn" data-post-id="{{ $post->id }}" data-type="dislike">
                Dislike ({{ $post->dislike_count }})
            </button>
        </div>
        
        <!-- Comments -->
        <div class="mb-3" id="post-{{ $post->id }}-comments">
            @foreach($post->comments as $comment)
                <div class="d-flex mb-2">
                    <img src="{{ $comment->user->profilePhoto ? asset('storage/'.$comment->user->profilePhoto) : asset('images/default-profile.png') }}" 
                         class="rounded-circle mr-2" width="30" height="30">
                    <div>
                        <strong>{{ $comment->user->name }}</strong>
                        <p class="mb-0">{{ $comment->content }}</p>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Comment form -->
        <form class="comment-form" data-post-id="{{ $post->id }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" rows="1" placeholder="Write a comment..."></textarea>
            </div>
        </form>
    </div>
</div>