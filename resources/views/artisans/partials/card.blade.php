<div class="card h-100 shadow-sm border-0 overflow-hidden artisan-card">
    <!-- Cover Image -->
    <div class="card-cover position-relative" 
         style="height: 120px; background: url('http://127.0.0.1:8000/images/logo.jpg') no-repeat center center / cover;">
        
        <!-- Gradient Overlay -->
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
        
        <!-- Profile Avatar - Now perfectly circular and prominent -->
        <div class="position-absolute top-100 start-0 translate-middle-y ms-3" style="z-index: 3;">
            <div class="avatar-frame" style="width: 85px; height: 85px;">
                <div class="avatar-image-wrapper">
                    <img src="{{ $artisan->photo ? asset('storage/'.$artisan->photo) : asset('images/artisan.jpg') }}" 
                         class="avatar-image" 
                         alt="{{ $artisan->name }}"
                         style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card Body -->
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

<style>
/* Enhanced Avatar Styling */
.avatar-frame {
    position: relative;
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    background: white;
    padding: 3px;
}

.avatar-image-wrapper {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
}

.avatar-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

/* Hover Effect */
.artisan-card:hover .avatar-image {
    transform: scale(1.05);
}

/* Cover Image Styling */
.card-cover {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}

/* Gradient Overlay */
.card-cover::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    z-index: 1;
}

/* Rating Badge Positioning */
.position-absolute.top-0.end-0 {
    z-index: 2;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .card-cover {
        height: 100px;
    }
    
    .avatar-frame {
        width: 75px;
        height: 75px;
    }
}
</style>