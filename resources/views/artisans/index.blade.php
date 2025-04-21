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
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="sortDropdown"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-sort me-1"></i> Sort
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">Name
                                (A-Z)</a></li>
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">Name
                                (Z-A)</a></li>
                        <li><a class="dropdown-item"
                                href="{{ request()->fullUrlWithQuery(['sort' => 'rating_asc']) }}">Rating (Low-High)</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ request()->fullUrlWithQuery(['sort' => 'rating_desc']) }}">Rating (High-Low)</a>
                        </li>
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
                                <input type="text" class="form-control" name="search" placeholder="Name or profession"
                                    value="{{ request('search') }}" aria-label="Search">
                            </div>
                        </div>

                        <div class="col-md-3">
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

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" name="location" placeholder="Location"
                                    value="{{ request('location') }}" aria-label="Location">
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

        {{-- <div class="row g-4"> --}}
            <!-- Artisan List -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @foreach ($artisans as $artisan)
                        <div class="col-xl-4 col-md-6">
                            @include('artisans.partials.card', ['artisan' => $artisan])
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Trigger -->
           {{--  @foreach ($announcements as $announcement)
                <div class="mb-3">
                    <h5>{{ $announcement->title }}</h5>
                    <button class="btn btn-info" data-bs-toggle="modal"
                        data-bs-target="#announcementModal{{ $announcement->id }}">
                        Show
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $announcement->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if ($announcement->image)
                                    <img src="{{ asset('storage/' . $announcement->image) }}" class="img-fluid mb-3">
                                @endif
                                <p>{{ $announcement->body }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
 --}}
       {{--  </div> --}}



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
