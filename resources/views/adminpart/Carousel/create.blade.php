@extends('layouts.admin') {{-- ولا layout ديالك --}}

@section('adminWorld')
<div class="container">
    <h2>Add New Carousel Image</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.carousels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="image" class="form-label">Carousel Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
