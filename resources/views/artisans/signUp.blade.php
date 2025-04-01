@extends('layouts.master')

@section('main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container py-5">
    <!-- Error Alert -->
    @if ($errors->any())
    <div class="alert alert-danger mb-4 shadow-sm border-0 rounded-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-semibold mb-0">Validation Errors</h5>
                <small class="text-muted">Please correct these errors and try again.</small>
            </div>
            <span class="badge bg-danger">{{ $errors->count() }} issues found</span>
        </div>
        <ul class="mt-3 mb-0">
            @foreach ($errors->all() as $error)
                <li class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle text-danger me-2"></i>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Form Container -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="card shadow-lg border-0 rounded-xl overflow-hidden">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Left Side - Image Background -->
                        <div class="col-md-4 d-none d-md-block">
                            <div class="h-100 bg-gradient-primary text-white p-5 d-flex flex-column justify-content-center align-items-center">
                                <i class="fas fa-user-tie fa-3x mb-4"></i>
                                <h3 class="fw-bold mb-2">Professional Profile</h3>
                                <p class="text-center mb-4">Create your professional presence</p>
                                <div class="w-100 text-center">
                                    <img src="{{ asset('images/avatar.jpg') }}" 
                                         class="img-fluid rounded-circle shadow-lg" 
                                         alt="Profile preview" style="max-width: 150px;">
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Form -->
                        <div class="col-md-8">
                            <div class="p-5">
                                <h4 class="mb-4 fw-bold text-primary">Professional Profile Setup</h4>
                                <form action="{{ route('artisans.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row g-4">
                                        <!-- Name & Email -->
                                        <div class="col-md-6">
                                            <div class="form-floating input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-user text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                                       id="name" name="name" 
                                                       value="{{ old('name') }}" 
                                                       placeholder=" " required>
                                                <label for="name" class="text-muted ps-4">Full Name</label>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-floating input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-envelope text-primary"></i>
                                                </span>
                                                <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                                       id="email" name="email" 
                                                       value="{{ old('email') }}" 
                                                       placeholder=" " required>
                                                <label for="email" class="text-muted ps-4">Email Address</label>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Password & Profession -->
                                        <div class="col-md-6">
                                            <div class="form-floating input-group position-relative">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-lock text-primary"></i>
                                                </span>
                                                <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                                       id="password" name="password" 
                                                       placeholder=" " required>
                                                <label for="password" class="text-muted ps-4">Password</label>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <span class="password-toggle position-absolute top-50 end-0 translate-middle-y ms-3">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-floating input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-tools text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0 @error('profession') is-invalid @enderror" 
                                                       id="profession" name="profession" 
                                                       value="{{ old('profession') }}" 
                                                       placeholder=" " required>
                                                <label for="profession" class="text-muted ps-4">Profession</label>
                                                @error('profession')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Phone & Address -->
                                        <div class="col-md-6">
                                            <div class="form-floating input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-phone text-primary"></i>
                                                </span>
                                                <input type="tel" class="form-control border-start-0 @error('phone') is-invalid @enderror" 
                                                       id="phone" name="phone" 
                                                       value="{{ old('phone') }}" 
                                                       placeholder=" " required>
                                                <label for="phone" class="text-muted ps-4">Phone Number</label>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-floating input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0 @error('address') is-invalid @enderror" 
                                                       id="address" name="address" 
                                                       value="{{ old('address') }}" 
                                                       placeholder=" " required>
                                                <label for="address" class="text-muted ps-4">Business Address</label>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Profile Photo -->
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label class="form-label d-flex align-items-center fw-semibold">
                                                    <i class="fas fa-image text-primary me-2"></i>
                                                    Profile Photo
                                                </label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                                           id="photo" name="photo" accept="image/*">
                                                    <button class="btn btn-outline-primary" type="button" id="uploadBtn">
                                                        <i class="fas fa-upload"></i>
                                                    </button>
                                                </div>
                                                @error('photo')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text text-muted mt-2">
                                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                                    Max 3MB (JPEG, PNG, JPG, GIF)
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bio -->
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control @error('bio') is-invalid @enderror" 
                                                          id="bio" name="bio" 
                                                          placeholder=" " 
                                                          style="height: 120px">{{ old('bio') }}</textarea>
                                                <label for="bio" class="text-muted ps-4">Professional Bio</label>
                                                <div class="form-text text-end text-muted mt-2">
                                                    Max 500 characters
                                                </div>
                                                @error('bio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary w-100 py-3">
                                                <i class="fas fa-user-check me-2"></i>
                                                Complete Registration
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Card Styles */
    .card {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    /* Background Section */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }

    /* Form Elements */
    .form-floating {
        margin-bottom: 1.5rem;
    }
    
    .form-control {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.25);
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        border-radius: 10px;
    }
    
    /* Input Groups */
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
        padding: 0.8rem 1rem;
    }
    
    /* Password Toggle */
    .password-toggle {
        cursor: pointer;
        color: #6c757d;
        transition: color 0.2s;
    }
    
    .password-toggle:hover {
        color: #4361ee;
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border: none;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        transform: translateY(-2px);
    }

    /* File Upload Button */
    #uploadBtn {
        border-radius: 0 10px 10px 0;
        border: 1px solid #dee2e6;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    #uploadBtn:hover {
        background: #e9ecef;
    }

    /* Error Alert */
    .alert-danger {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1);
    }
    
    .alert-danger ul {
        list-style-type: none;
        padding-left: 0;
    }
    
    .alert-danger li {
        padding: 0.3rem 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card {
            border-radius: 15px;
        }
        
        .card-body {
            padding: 2rem 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password Toggle
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.closest('.form-floating').querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    
        // Character Counter for Bio
        const bioTextarea = document.getElementById('bio');
        bioTextarea.addEventListener('input', function() {
            const remaining = 500 - this.value.length;
            const counter = this.nextElementSibling.querySelector('.form-text');
            counter.textContent = `${remaining} characters remaining`;
            if(remaining < 50) {
                counter.style.color = '#dc3545';
            } else {
                counter.style.color = '#6c757d';
            }
        });
    });
</script>
@endsection