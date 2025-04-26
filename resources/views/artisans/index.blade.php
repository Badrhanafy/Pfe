@extends('layouts.master')

@section('main')
<div class="container-fluid professional-layout">
    <div class="row g-0 h-100">
        <!-- Artisans Scrollable Column -->
        <div class="col-lg-8 artisan-column">
            <div class="h-100 d-flex flex-column">
                <!-- Filter Header -->
                <div class="filter-header p-4 border-bottom bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 fw-bold mb-0">
                            <i class="fas fa-hammer me-2 text-primary"></i>
                            Professional Artisans
                        </h2>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort me-1"></i> Sort
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Name (A-Z)</a></li>
                                <li><a class="dropdown-item" href="#">Name (Z-A)</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Rating (Low-High)</a></li>
                                <li><a class="dropdown-item" href="#">Rating (High-Low)</a></li>
                            </ul>
                        </div>
                    </div>

                    <form id="filterForm" method="GET" action="{{ route('artisans.index') }}">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control" 
                                           name="search" placeholder="Search by name or profession..."
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <select class="form-select" name="profession">
                                    <option value="">All Professions</option>
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession }}"
                                            {{ request('profession') == $profession ? 'selected' : '' }}>
                                            {{ $profession }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 d-flex">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                                <a href="{{ route('artisans.index') }}" class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-undo"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Scrollable Artisans Grid -->
                <div class="artisan-scrollable flex-grow-1 overflow-auto p-4">
                    <div class="row g-4">
                        @foreach ($artisans as $artisan)
                            <div class="col-12">
                                @include('artisans.partials.card', ['artisan' => $artisan])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Fixed Announcements Sidebar -->
        <div class="col-lg-4 announcement-sidebar bg-light border-start">
            <div class="sticky-sidebar">
                <div class="sidebar-header p-4 border-bottom">
                    <h3 class="h5 fw-bold mb-0">
                        <i class="fas fa-bullhorn me-2 text-primary"></i>
                        Latest Updates
                    </h3>
                </div>
                
                <div class="announcement-feed p-4">
                    @forelse($announcements as $announcement)
                        <div class="announcement-card mb-4">
                            @if ($announcement->image)
                            <div class="announcement-image mb-3">
                                <img src="{{ $announcement->image }}" 
                                     class="img-fluid rounded" 
                                     alt="Announcement">
                            </div>
                            @endif
                            <div class="announcement-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="announcement-title fw-bold mb-0">{{ $announcement->title }}</h5>
                                    <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="announcement-text text-muted small mb-3">
                                    {{ Str::limit($announcement->content, 100) }}
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    Read More <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state text-center py-4">
                            <i class="fas fa-comment-slash fs-4 text-muted mb-3"></i>
                            <p class="text-muted mb-0">No announcements available</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when filters change
    const filterForm = document.getElementById('filterForm');
    const filterInputs = filterForm.querySelectorAll('select, input');
    
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (input.name !== 'search' || input.value.length >= 2) {
                filterForm.submit();
            }
        });
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection

<style>
.professional-layout {
    height: 100vh;
    overflow: hidden;
}

.artisan-column {
    height: 100vh;
    display: flex;
    flex-direction: column;
}

.filter-header {
    position: sticky;
    top: 0;
    z-index: 10;
}

.artisan-scrollable {
    scrollbar-width: thin;
    scrollbar-color: #dee2e6 transparent;
}

.artisan-scrollable::-webkit-scrollbar {
    width: 6px;
}

.artisan-scrollable::-webkit-scrollbar-thumb {
    background-color: #dee2e6;
    border-radius: 3px;
}

.announcement-sidebar {
    height: 100vh;
    overflow: hidden;
}

.sticky-sidebar {
    height: 100vh;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    background: white;
    position: sticky;
    top: 0;
    z-index: 10;
}

.announcement-feed {
    flex-grow: 1;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #dee2e6 transparent;
}

.announcement-feed::-webkit-scrollbar {
    width: 6px;
}

.announcement-feed::-webkit-scrollbar-thumb {
    background-color: #dee2e6;
    border-radius: 3px;
}

.announcement-card {
    background: white;
    border-radius: 8px;
    padding: 1.25rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.announcement-card:hover {
    transform: translateY(-2px);
}

.announcement-image {
    height: 160px;
    overflow: hidden;
    border-radius: 6px;
}

.announcement-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@media (max-width: 991.98px) {
    .professional-layout {
        height: auto;
        overflow: visible;
    }
    
    .artisan-column, .announcement-sidebar {
        height: auto;
    }
    
    .sticky-sidebar {
        height: auto;
        position: relative;
    }
    
    .announcement-feed {
        height: auto;
        overflow: visible;
    }
}
</style>
@endsection