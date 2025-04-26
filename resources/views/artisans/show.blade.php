@extends('layouts.master')

@section('main')
       {{--  @if(!Auth::check())
           <script>window.location.href = "/Userlogin";</script>
        @endif --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<div class="container py-5">
    <div class="row align-items-stretch g-4">
        <!-- Left Column - Profile Information -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <!-- Profile Header -->
                    <div class="text-center mb-4">
                        <div class="profile-photo-preview mb-4" >
                            <img src="{{ $artisan->photo ? asset('storage/' . $artisan->photo) :asset('images/artisan.jpg') }}" 
                                 class="rounded-circle border border-white border-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;" 
                                 alt="{{ $artisan->name }}"
                                 >
                        </div>
                        <h2 class="text-primary fw-bold mb-1">{{ $artisan->name }}</h2>
                        <p class="text-muted mb-3">{{ $artisan->profession }}</p>
                        @if($artisan->is_verified)
                            <span class="badge bg-success mb-3">Verified</span>
                        @endif
                    </div>

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

                    <!-- Profile Details -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">Details</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p class="text-muted mb-1"><i class="fas fa-envelope me-2 text-primary"></i>{{ $artisan->email }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <p class="text-muted mb-1"><i class="fas fa-phone-alt me-2 text-primary"></i>{{ $artisan->phone }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <p class="text-muted mb-1"><i class="fas fa-map-marker-alt me-2 text-primary"></i>{{ $artisan->address }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <p class="text-muted mb-1"><i class="fas fa-briefcase me-2 text-primary"></i>{{ $artisan->experience_years }} years experience</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">About Me</h4>
                        <p class="text-muted">{{ $artisan->bio ?? 'No bio available' }}</p>
                    </div>

                    <!-- Message Form -->
                    
                  <div class="border-top pt-4">
                     <h4 class="fw-bold mb-3">Send Message</h4>
                     <form method="POST" action="{{ route('messages.send') }}">
                         @csrf
                         <input type="hidden" name="artisan_id" value="{{ $artisan->id }}">
                         <div class="mb-3">
                             <label for="message" class="form-label">Your Message</label>
                             <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                         </div>
                         <button type="submit" class="btn btn-primary w-100">Send Message</button>
                     </form>
                 </div>
              </div>
            </div>
        </div>

        <!-- Right Column - Ratings & Reviews -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <!-- Reviews Section -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">Client Reviews</h4>
                        @if($reviews->count() > 0)
                            @foreach($reviews as $review)
                                <div class="card border-0 mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-muted mb-1">{{ $review->created_at->format('M d, Y') }}</p>
                                        <p class="mb-0">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center mt-3">
                                {{ $reviews->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <p class="text-muted">No reviews yet.</p>
                        @endif
                    </div>

                    <!-- Review Form -->
                    <div class="border-top pt-4">
                        <h4 class="fw-bold mb-3">Leave a Review</h4>
                        <form method="POST" action="{{ route('reviews.store', $artisan) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="rating-input">
                                    <input type="hidden" id="ratingValue" name="rating" value="0">
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="far fa-star" data-rating="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Star Rating Functionality
    const stars = document.querySelectorAll('.star-rating i');
    const ratingValue = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            highlightStars(rating);
        });

        star.addEventListener('mouseout', function() {
            const currentRating = ratingValue.value;
            highlightStars(currentRating || 0);
        });

        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingValue.value = rating;
            highlightStars(rating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            const starRating = star.getAttribute('data-rating');
            if (starRating <= rating) {
                star.classList.remove('far');
                star.classList.add('fas');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    }
});
</script>

<style>
.star-rating {
    font-size: 24px;
    color: #ffc107;
    cursor: pointer;
}

.star-rating i {
    margin-right: 5px;
    transition: color 0.3s;
}

.star-rating i:hover {
    color: #ffcc00;
}

.rounded-4 {
    border-radius: 1rem !important;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection