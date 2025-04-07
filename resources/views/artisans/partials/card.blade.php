<div class="card h-100 shadow-sm border-0 overflow-hidden artisan-card">
    <!-- Cover Image -->
    <div class="card-cover position-relative" 
         style="background-image: url('http://127.0.0.1:8000/images/logo.jpg');
                height: 120px">
        <div class="position-absolute bottom-0 start-0 end-0 h-50" 
             style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);"></div>
        
        <!-- Rating Badge -->
        <div class="position-absolute top-0 end-0 m-2">
            <div class="d-flex align-items-center bg-white bg-opacity-90 px-2 py-1 rounded-pill shadow-sm">
                <i class="fas fa-star text-warning me-1 small"></i>
                <span class="fw-bold small">{{ number_format($artisan->average_rating, 1) }}</span>
                <span class="text-muted ms-1 small">({{ $artisan->reviews_count }})</span>
            </div>
        </div>
        
        <!-- Profile Avatar -->
        <div class="position-absolute top-100 start-0 translate-middle-y ms-3">
            <img src="{{ $artisan->photo ? asset('storage/'.$artisan->photo) : asset('images/artisan.jpg') }}" 
                 class="rounded-circle border border-3 border-white shadow-sm" 
                 width="80" height="80" 
                 alt="{{ $artisan->name }}"
                 style="object-fit: cover;">
        </div>
    </div>
    
    <!-- Card Body -->
    <div class="card-body pt-5">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title fw-bold mb-0">{{ $artisan->name }}</h5>
            @if($artisan->is_verified)
                <span class="badge bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-circle me-1"></i> Verified
                </span>
            @endif
        </div>
        
        <p class="text-muted mb-2">
            <i class="fas fa-briefcase me-1 text-primary"></i> {{ $artisan->profession }}
        </p>
        
        <p class="text-muted mb-3">
            <i class="fas fa-map-marker-alt me-1 text-primary"></i> {{ Str::limit($artisan->address, 30) }}
        </p>
        
        <!-- Detailed Rating -->
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="rating-stars mb-1">
                    @php $rating = round($artisan->average_rating) @endphp
                    @for($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= $rating ? 'fas' : 'far' }} fa-star text-warning"></i>
                    @endfor
                </div>
                <small class="text-muted">
                    {{ $artisan->reviews_count }} {{ Str::plural('review', $artisan->reviews_count) }}
                </small>
            </div>
            <a href="{{ route('ArtProfile', $artisan) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-eye me-1"></i> View
            </a>
        </div>
    </div>
</div>