@extends('layouts.master')

@section('main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-primary fw-bold mb-0">Professional Artisans</h2>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort by
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                <li><a class="dropdown-item" href="#">Name (A-Z)</a></li>
                                <li><a class="dropdown-item" href="#">Name (Z-A)</a></li>
                                <li><a class="dropdown-item" href="#">Rating (High-Low)</a></li>
                                <li><a class="dropdown-item" href="#">Rating (Low-High)</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Search and Filter Form -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name or profession" aria-label="Search" id="searchInput">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="professionFilter">
                                <option selected disabled value="">Select Profession</option>
                                @if(isset($professions) && $professions->isNotEmpty())
                                    @foreach($professions as $profession)
                                        <option value="{{ $profession }}">{{ ucfirst($profession) }}</option>
                                    @endforeach
                                @else
                                    <option disabled>No professions available</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Location" id="locationFilter">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary w-100" id="clearFilters">
                                Clear
                            </button>
                        </div>
                    </div>

                    <!-- Artisan Cards -->
                    <div class="row g-4" id="artisanGrid">
                        @foreach($artisans as $artisan)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border-0 rounded-4 overflow-hidden">
                                    <!-- Card Background -->
                                    <div class="position-relative">
                                        <div class="bg-image h-100" style="background-image: url('{{ asset('images/backg.jpg') }}'); background-size: cover; background-position: center;"></div>
                                        <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));"></div>
                                    </div>
                                    
                    
                                    <!-- Profile Photo -->
                                    <div class="profile-photo-container position-absolute top-0 start-0 mt-4 ms-4">
                                        <img src="{{ asset('storage/' . ($artisan->photo ?? 'images/worker-placeholder.svg')) }}" 
                                             class="rounded-circle border border-white border-3" 
                                             style="width: 80px; height: 80px; object-fit: cover;" 
                                             alt="{{ $artisan->name }}">
                                    </div>
                    
                                    <!-- Card Content -->
                                    <div class="card-body bg-white p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title fw-bold">{{ $artisan->name }}</h5>
                                            @if(isset($artisan->is_verified) && $artisan->is_verified)
                                                <span class="badge bg-success">Verified</span>
                                            @endif
                                        </div>
                                        <p class="card-text text-muted mb-2">{{ $artisan->profession }}</p>
                                        <p class="card-text text-muted mb-3"><i class="fas fa-map-marker-alt me-2 text-primary"></i>{{ $artisan->address }}</p>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="rating">
                                                 <!-- Overall Rating -->
                    <div class="mb-4 text-center">
                        <h4 class="fw-bold mb-3">Overall Rating</h4>
                        <div class="rating mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $artisan->averageRating ?? 0 ? 'fas' : 'far' }} fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="fw-bold text-muted">{{ $artisan->averageRating ?? 'N/A' }}/5 ({{ $artisan->reviews_count ?? 0 }} reviews)</p>
                    </div>
                                            </div>
                                            <a href="{{ route('profile', $artisan) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-user"></i> Show Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
{{-- @if (Auth::user()->progilePhoto)
<p>lienr : {{ asset('storage/' . Auth::user()->profilePhoto) }}</p>
@else
    <p>no photo path</p>
@endif --}}
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                       {{--  {{ $artisans->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const searchInput = document.getElementById('searchInput');
        const professionFilter = document.getElementById('professionFilter');
        const locationFilter = document.getElementById('locationFilter');
        const clearFilters = document.getElementById('clearFilters');
        const artisanGrid = document.getElementById('artisanGrid');

        // Apply filters on input change
        searchInput.addEventListener('input', applyFilters);
        professionFilter.addEventListener('change', applyFilters);
        locationFilter.addEventListener('input', applyFilters);

        // Clear filters
        clearFilters.addEventListener('click', function() {
            searchInput.value = '';
            professionFilter.value = '';
            locationFilter.value = '';
            applyFilters();
        });

        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const profession = professionFilter.value;
            const location = locationFilter.value.toLowerCase();

            // Here you would typically send an AJAX request to the server
            // For demonstration purposes, we'll just log the filters
            console.log('Search:', searchTerm);
            console.log('Profession:', profession);
            console.log('Location:', location);

            // In a real implementation, you would:
            // 1. Prevent default form submission
            // 2. Send an AJAX request to your controller
            // 3. Update the artisanGrid with the new results
        }
    });
</script>
@endsection