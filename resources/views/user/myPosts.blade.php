@extends('layouts.master')

@section('main')
<div class="container my-5">
    <h2 class="mb-4 text-center">User Posts</h2>
    
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($Userposts as $post)
        <div class="col">
            <div class="card shadow-sm h-100">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post image" style="height: 250px; object-fit: cover;">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($post->content, 150, '...') }}</p>
                    
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <span class="me-2"><i class="bi bi-hand-thumbs-up"></i> {{ $post->reactions->where('type', 'like')->count() }}</span>
                                <span><i class="bi bi-hand-thumbs-down"></i> {{ $post->reactions->where('type', 'dislike')->count() }}</span>
                            </div>
                            <div>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>

                        <hr>
                        <small class="text-muted">{{ count($post->comments) }} comments</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
