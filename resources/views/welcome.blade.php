@extends('layouts.master')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Finder - Find Professional Services</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .slider-height {
            height: 500px;
        }
        
        .service-card {
            transition: transform 0.3s;
            height: 100%;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #3498db;
        }
        
        .btn-primary {
            background-color: #3498db;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-outline-light:hover {
            color: #3498db;
        }
        
        .section-padding {
            padding: 60px 0;
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, #3498db, #9b59b6);
        }
        
        .text-shadow {
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        
        .search-box {
            border-radius: 50px;
            padding: 15px 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProConnect - Artisan Finder</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
</head>
<body>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <!-- Slider -->
    <div id="mainSlider" class="carousel slide slider-height" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="" class="d-block w-100 h-100 object-fit-cover" alt="Construction Services">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4 text-shadow">Find Professional Construction Experts</h1>
                    <p class="text-shadow">Quality workmanship at affordable prices</p>
                    <button class="btn btn-primary btn-lg">Search Now</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="public/storage/repair.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Beauty Services">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4 text-shadow">Expert Beauty & Wellness Services</h1>
                    <p class="text-shadow">Transform your look with professional stylists</p>
                    <button class="btn btn-primary btn-lg">Browse Services</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/1600x900/?repair" class="d-block w-100 h-100 object-fit-cover" alt="Repair Services">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4 text-shadow">Reliable Home Repair Specialists</h1>
                    <p class="text-shadow">Fix it right the first time</p>
                    <button class="btn btn-primary btn-lg">Find Artisans</button>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Introduction Section -->
    <section class="section-padding bg-light">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="mb-4">Find Quality Artisans Near You</h2>
                    <p class="lead mb-5">
                        Connect with verified professionals for all your home improvement, repair, and service needs.
                        Browse through thousands of artisans with verified reviews and ratings.
                    </p>
                    <div class="search-box mx-auto" style="max-width: 600px;">
                        <div class="input-group">
                            <select class="form-select" id="serviceType">
                                <option selected>Choose Service</option>
                                <option>Plumbing</option>
                                <option>Electrical</option>
                                <option>Carpentry</option>
                                <option>Painting</option>
                                <option>Beauty Services</option>
                                <option>More...</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Location" aria-label="Location">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Verified Professionals</h3>
                    <p>All artisans undergo a verification process to ensure quality and reliability.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Customer Reviews</h3>
                    <p>Read honest reviews from previous customers to make informed decisions.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure Payments</h3>
                    <p>Pay securely through our platform with multiple payment options available.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section-padding bg-light">
        <div class="container text-center">
            <h2 class="mb-5">Popular Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card service-card">
                        <div class="card-body">
                            <i class="fas fa-tools fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Home Repair</h5>
                            <p class="card-text">From plumbing to electrical work, find certified professionals for all your repair needs.</p>
                            <a href="#" class="btn btn-outline-primary">View Artisans</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card service-card">
                        <div class="card-body">
                            <i class="fas fa-paint-roller fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Interior Design</h5>
                            <p class="card-text">Transform your space with expert interior designers and decorators.</p>
                            <a href="#" class="btn btn-outline-primary">View Artisans</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card service-card">
                        <div class="card-body">
                            <i class="fas fa-cut fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Beauty Services</h5>
                            <p class="card-text">Book appointments with stylists, makeup artists, and other beauty professionals.</p>
                            <a href="#" class="btn btn-outline-primary">View Artisans</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding bg-gradient text-white text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Find Your Perfect Artisan?</h2>
            <p class="lead mb-5">Join thousands of satisfied customers who've found quality service providers through our platform.</p>
            <a href="#" class="btn btn-light btn-lg px-5">Get Started</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>About ArtisanFinder</h5>
                    <p>Connecting customers with quality service providers since 2023.</p>
                    <div class="mt-4">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="#" class="text-white text-decoration-none">About</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Service Street, City</li>
                        <li><i class="fas fa-phone me-2"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope me-2"></i> info@artisanfinder.com</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Newsletter</h5>
                    <p>Subscribe to get updates on new services and special offers.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">© 2023 ArtisanFinder. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection