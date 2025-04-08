@extends('layouts.master')

@section('main')
<div class="container py-5">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div class="mb-3 mb-md-0">
            <h1 class="fw-bold text-primary">Professional Artisans</h1>
            <p class="text-muted mb-0">Find skilled professionals in your area</p>
        </div>
        
        <div class="d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-sort me-1"></i> Sort
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">Name (A-Z)</a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">Name (Z-A)</a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'rating_asc']) }}">Rating (Low-High)</a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'rating_desc']) }}">Rating (High-Low)</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-5">
        <div class="card-body p-4">
            <form id="filterForm" method="GET" action="{{ route('artisans.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" 
                                   placeholder="Name or profession" 
                                   value="{{ request('search') }}"
                                   aria-label="Search">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <select class="form-select" name="profession">
                            <option value="">All Professions</option>
                             @foreach($professions as $profession)
                                <option value="{{ $profession }}" {{ request('profession') == $profession ? 'selected' : '' }}>
                                    {{ $profession }}
                                </option>
                            @endforeach 
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" name="location" 
                                   placeholder="Location" 
                                   value="{{ request('location') }}"
                                   aria-label="Location">
                        </div>
                    </div>
                    
                    <div class="col-md-2 d-flex">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('artisans.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Artisan Grid -->
    @if($artisans->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No artisans found</h4>
                <p class="text-muted">Try adjusting your search filters</p>
                <a href="{{ route('artisans.index') }}" class="btn btn-primary mt-3">
                    Clear Filters
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($artisans as $artisan)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    @include('artisans.partials.card', ['artisan' => $artisan])
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
           {{--  {{ $artisans->withQueryString()->links() }} --}}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when filters change (optional)
    const filterForm = document.getElementById('filterForm');
    const filterInputs = filterForm.querySelectorAll('select, input');
    
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Only auto-submit if not empty search field
            if (input.name !== 'search' || input.value.length >= 2) {
                filterForm.submit();
            }
        });
    });
});
</script>
@endsection