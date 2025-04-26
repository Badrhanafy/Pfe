@extends('layouts.master') {{-- ولا admin layout اذا عندك --}}

@section('main')
<div class="container py-5">
    <h2 class="mb-4">Create New Announcement</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('publishAnnouncement') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label fw-bold">Body</label>
            <textarea name="body" id="body" rows="4" class="form-control" required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-bullhorn me-1"></i> Create Announcement
        </button>

        <a href="{{ route('adminpart.announcements.index') }}" class="btn btn-secondary ms-2">
            Cancel
        </a>
    </form>
</div>
@endsection
