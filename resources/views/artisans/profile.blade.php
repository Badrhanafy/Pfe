@extends('layouts.artisan')

@section('artisanWorld')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Update Profile Modal -->
<!-- Update Profile Modal -->
<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-gradient-primary text-white rounded-top">
                <h4 class="modal-title d-flex align-items-center">
                    <i class="fas fa-user-edit fa-lg mr-2"></i> Profile Update
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('artisan.update', $artisan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-user-tag input-icon"></i>
                                <input type="text" class="form-control pl-40" name="name" 
                                       value="{{ $artisan->name }}" placeholder="Full Name" required>
                                <label class="floating-label">Full Name</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-briefcase input-icon"></i>
                                <input type="text" class="form-control pl-40" name="profession" 
                                       value="{{ $artisan->profession }}" placeholder="Profession" required>
                                <label class="floating-label">Profession</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                <input type="text" class="form-control pl-40" name="address" 
                                       value="{{ $artisan->address }}" placeholder="Address" required>
                                <label class="floating-label">Address</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="tel" class="form-control pl-40" name="phone" 
                                       value="{{ $artisan->phone }}" placeholder="Phone Number" required>
                                <label class="floating-label">Phone Number</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control pl-40" name="email" 
                                       value="{{ $artisan->email }}" placeholder="Email Address" required>
                                <label class="floating-label">Email Address</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-chart-line input-icon"></i>
                                <input type="number" class="form-control pl-40" name="experience_years" 
                                       value="{{ $artisan->experience_years }}" placeholder="Experience (Years)" required>
                                <label class="floating-label">Experience (Years)</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-camera input-icon"></i>
                                <input type="file" class="form-control pl-40" name="photo" 
                                       placeholder="Profile Photo">
                                <label class="floating-label">Profile Photo</label>
                                <small class="form-text text-muted ml-40">
                                    Current: {{ $artisan->photo ?? 'None' }}
                                </small>
                                <span class="input-border"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group magic-input position-relative">
                                <i class="fas fa-align-left input-icon"></i>
                                <textarea class="form-control pl-40" name="bio" rows="3" 
                                          placeholder="Bio">{{ $artisan->bio }}</textarea>
                                <label class="floating-label">Bio</label>
                                <span class="input-border"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-outline-secondary mr-3" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn magic-btn">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main Profile Section -->
<section class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="cover-photo rounded-top magic-gradient">
            <button class="btn btn-outline-light btn-sm float-end m-3" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                <i class="fas fa-edit"></i> Edit Profile
            </button>
        </div>
        
        <!-- Profile Intro -->
        <div class="profile-intro text-center magic-avatar">
            <div class="avatar-container">
                <img src="{{ $artisan->photo ? asset('storage/' . $artisan->photo) : asset('images/avatar.avif') }}" 
                     alt="{{ $artisan->name }}" class="avatar-img rounded-circle magic-hover">
                <span class="status-indicator bg-success magic-pulse"></span>
            </div>
            
            <div class="profile-meta mt-4">
                <h1 class="name">{{ $artisan->name }}</h1>
                <div class="profession text-primary">{{ $artisan->profession }}</div>
                <div class="location mt-2">
                    <i class="fas fa-map-marker-alt magic-shake"></i> {{ $artisan->address }}
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="profile-body mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-4">
                <!-- Professional Summary -->
                <div class="card mb-4 magic-widget">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="fas fa-briefcase"></i> Professional Summary
                        </h5>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h4 class="mb-0">{{ $artisan->experience_years }}+</h4>
                                <small>Years Experience</small>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $artisan->completed_projects ?? 0 }}</h4>
                                <small>Projects Completed</small>
                            </div>
                        </div>
                        <a href="{{ route('Messagebox', $artisan->id) }}" class="btn btn-danger btn-block mt-4 magic-btn-sm">
                            <i class="fas fa-envelope"></i> View Messages
                        </a>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card mb-4 magic-contact">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="fas fa-address-book"></i> Contact Information
                        </h5>
                        <ul class="list-unstyled mt-3 magic-icons">
                            <li class="mb-2">
                                <i class="fas fa-phone mr-2 magic-swing"></i>
                                <a href="tel:{{ $artisan->phone }}">{{ $artisan->phone }}</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope mr-2 magic-float"></i>
                                <a href="mailto:{{ $artisan->email }}">{{ $artisan->email }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="card mb-4 magic-fade">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="fas fa-user-alt"></i> About Me
                        </h5>
                        <p class="card-text mt-3">{{ $artisan->bio ?? 'No bio available' }}</p>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="card magic-counter">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="fas fa-chart-line"></i> Professional Experience
                        </h5>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="experience-card p-3 magic-card">
                                    <h4 class="mb-0">{{ $artisan->experience_years }}+</h4>
                                    <small class="text-muted">Years of Experience</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="experience-card p-3 magic-card">
                                    <h4 class="mb-0">{{ $artisan->profession }}</h4>
                                    <small class="text-muted">Specialization</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</section>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<style>
    /* Professional Base Styles */
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .cover-photo {
        height: 250px;
        background: rgb(178,177,206);
        position: relative;
        border-radius: 15px 15px 0 0;
    }
    
    .avatar-container {
        position: relative;
        margin-top: -75px;
    }
    
    .avatar-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid rgb(152, 160, 236);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .status-indicator {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
    }
    
    .profile-meta .name {
        font-size: 2.2rem;
        color: #1a202c;
    }
    
    .profession {
        font-size: 1.2rem;
        color: #3182ce;
    }
    
    .location {
        color: #4a5568;
        font-size: 0.9rem;
    }
    
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .experience-card {
        border-left: 4px solid #3182ce;
        transition: transform 0.2s ease;
    }
    
   
    
    /* Magical Enhancements */
    .magic-gradient {
        animation: gradientAnimation 15s ease infinite;
    }
    
    .magic-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .magic-pulse {
        animation: pulse 2s infinite;
    }
    
    .magic-input {
        position: relative;
    }
    
    .magic-input .form-control {
        background: transparent;
        border: none;
        border-bottom: 2px solid #ddd;
        border-radius: 0;
        padding: 10px;
        transition: all 0.3s ease;
    }
    
    .magic-input .input-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #6366f1, #10b981);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .magic-input .form-control:focus ~ .input-border {
        transform: scaleX(1);
    }
    
    .magic-btn {
        background: linear-gradient(45deg, #6366f1, #10b981);
        padding: 12px 30px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }
    
    .magic-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .magic-btn-sm {
        padding: 8px 20px;
        border-radius: 20px;
        margin: 15px 0;
    }
    
    .magic-widget:hover {
        transform: perspective(1000px) rotateY(10deg);
        transition: transform 0.5s ease;
    }
    
    .magic-contact i {
        transition: transform 0.3s ease;
    }
    
    .magic-contact li:hover i {
        transform: rotate(20deg);
    }
    
    .magic-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .magic-fade {
        opacity: 0;
        animation: fadeIn 1s ease forwards;
    }
    
    .magic-shake {
        animation: shake 0.5s ease infinite;
    }
    
    /* Animations */
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    @keyframes pulse {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1); opacity: 1; }
        100% { transform: scale(0.95); opacity: 0.8; }
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-3px); }
        50% { transform: translateX(3px); }
        75% { transform: translateX(-3px); }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .cover-photo {
            height: 150px;
        }
        
        .avatar-img {
            width: 100px;
            height: 100px;
            margin-top: -50px;
        }
        
        .profile-meta .name {
            font-size: 1.8rem;
        }
        
        .magic-contact li:hover i {
            transform: none;
        }
        
        .magic-widget:hover {
            transform: none;
        }
    }
   /* Modal Form Enhancements */
.modal-lg {
    max-width: 900px !important;
}

.modal-content {
    border-radius: 15px;
    border: none;
}

.modal-header {
    border-bottom: none;
    padding: 1.5rem 2rem;
}

.modal-body {
    max-height: 80vh;
}

.magic-input {
    margin-bottom: 1.5rem;
}

.input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
    color: #6366f1;
    transition: color 0.3s ease;
}

.pl-40 {
    padding-left: 40px !important;
}

.floating-label {
    position: absolute;
    left: 40px;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.3s ease;
    pointer-events: none;
    color: #6c757d;
}

.magic-input .form-control:focus ~ .floating-label,
.magic-input .form-control:not(:placeholder-shown) ~ .floating-label {
    transform: translateY(-125%);
    font-size: 0.8rem;
    color: #6366f1;
}

.magic-input .form-control {
    border: none;
    border-bottom: 2px solid #ddd;
    border-radius: 0;
    background: transparent;
    transition: all 0.3s ease;
}

.magic-input .input-border {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #10b981);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.magic-input .form-control:focus ~ .input-border {
    transform: scaleX(1);
}

.form-control-file {
    padding-left: 40px !important;
}

.form-text.ml-40 {
    margin-left: 40px !important;
}

.btn.magic-btn {
    background: linear-gradient(45deg, #6366f1, #10b981);
    padding: 0.75rem 2rem;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn.magic-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
    </style>

<script>
    // Modal enhancements
    $('#updateProfileModal').on('show.bs.modal', function () {
        $(this).find('.modal-content').css('transform', 'scale(1)');
    });
    
    $('#updateProfileModal').on('hidden.bs.modal', function () {
        $(this).find('.modal-content').css('transform', 'scale(0.9)');
    });
    
    // Number counter animation
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.experience-value[data-count]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const count = parseInt(target.getAttribute('data-count'));
                    const step = Math.ceil(count / 20);
                    let current = 0;
                    const timer = setInterval(() => {
                        current += step;
                        if (current > count) {
                            target.textContent = count + '+';
                            clearInterval(timer);
                        } else {
                            target.textContent = current;
                        }
                    }, 50);
                    observer.unobserve(target);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => observer.observe(counter));
    });
    </script>
@endsection