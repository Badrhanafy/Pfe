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
    <!-- Slider -->
<div id="mainSlider" class="carousel slide slider-height" data-bs-interval="4000" data-bs-ride="carousel" data-bs-wrap="true">
    
    <div class="carousel-inner">
        @foreach($carousels as $index => $carousel)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset($carousel->image) }}" class="d-block w-100 h-100 object-fit-cover" alt="Carousel Image">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4 text-shadow text-white fw-bold">{{ $carousel->title }}</h1>
                    <p class="text-shadow">{{ $carousel->description }}</p>
                    <button class="btn btn-primary btn-lg">Find Experts</button>
                </div>
            </div>
        @endforeach
        <script>
            const myCarousel = document.querySelector('#mainSlider');
            const carousel = new bootstrap.Carousel(myCarousel, {
                interval: 4000,
                wrap: true
            });
        </script>
        
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    {{-- carousel indecatiors  --}}
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="2"></button>
    </div>
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
                    <h3>Direct contact</h3>
                    <p>Contact the artisans directly without any intermidiates</p>
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
   {{-- Artisans highlights and benefits --}}
<section class="artisan-benefits section-padding  text-center" style="background-color:rgb(249,245,253)">
    <div class="container">
        <h2 class="section-title mb-4">Why Join Our Platform?</h2>
        <p class="section-subtitle mb-5">As an artisan, you have a lot to gain by joining our community. Discover the benefits below.</p>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="card-inner">
                    <div class="icon-wrapper">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>High Reputation</h3>
                    <p>Build your reputation with verified reviews and ratings from satisfied customers.</p>
                </div>
            </div>
            
            <div class="benefit-card">
                <div class="card-inner">
                    <div class="icon-wrapper">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>More Clients</h3>
                    <p>Expand your client base by reaching thousands of potential customers.</p>
                </div>
            </div>
            
            <div class="benefit-card">
                <div class="card-inner">
                    <div class="icon-wrapper">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3>Perfect Style</h3>
                    <p>Showcase your work in a beautifully designed and responsive layout.</p>
                </div>
            </div>
            
            <div class="benefit-card">
                <div class="card-inner">
                    <div class="icon-wrapper">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Grow Your Business</h3>
                    <p>Use our tools to manage bookings, track your earnings, and grow your business.</p>
                </div>
            </div>
        </div>
        
        <a href="{{ route('showSignUpForm') }}" class="cta-button">
            <span>Join Now</span>
            <svg viewBox="0 0 13 10" height="10px" width="15px">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </a>
    </div>

    <style>
        .artisan-benefits {
            padding: 100px 0;
            background: #f8f9fa;
            overflow: hidden;
        }

        .section-title {
            font-size: 2.8rem;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease 0.2s;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .benefit-card {
            perspective: 1000px;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease;
        }

        .card-inner {
            background: white;
            border-radius: 15px;
            padding: 40px 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        .card-inner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(106,17,203,0.1));
            transform: rotate(45deg);
            transition: all 0.6s ease;
        }

        .benefit-card:hover .card-inner {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }

        .benefit-card:hover .card-inner::before {
            transform: rotate(45deg) translateY(20%);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            transition: all 0.4s ease;
            position: relative;
        }

        .icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid #6a11cb;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .benefit-card:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .benefit-card:hover .icon-wrapper::after {
            opacity: 1;
            transform: scale(1.2);
        }

        .benefit-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #2d3436;
            transition: color 0.3s ease;
        }

        .benefit-card p {
            color: #636e72;
            line-height: 1.6;
            font-size: 1rem;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            padding: 18px 40px;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            overflow: hidden;
            position: relative;
            transition: all 0.4s ease;
            margin-top: 50px;
        }

        .cta-button svg {
            margin-left: 10px;
            stroke: white;
            transition: all 0.3s ease;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255,255,255,0.3),
                transparent
            );
            transition: all 0.6s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(106,17,203,0.2);
        }

        .cta-button:hover::before {
            left: 100%;
        }

        /* Animation Classes */
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px'
            };

            const animateOnScroll = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Observe elements
            document.querySelectorAll('.section-title, .section-subtitle, .benefit-card').forEach(el => {
                animateOnScroll.observe(el);
            });

            // Stagger animation for benefit cards
            document.querySelectorAll('.benefit-card').forEach((card, index) => {
                card.style.transitionDelay = `${index * 0.1}s`;
            });
        });
    </script>
</section>

    <!-- Call to Action -->
    <section class="section-padding bg-gradient text-white text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Find Your Perfect Artisan?</h2>
            <p class="lead mb-5">Join thousands of satisfied customers who've found quality service providers through our platform.</p>
            <a href="#" id="getStartedBtn" class="btn btn-light btn-lg px-5">Get Started <i class="fas fa-arrow-right"></i></a>
    
            <!-- Modal -->
            <div class="modal fade" id="profileTypeModal" tabindex="-1" role="dialog" aria-labelledby="profileTypeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="profileTypeModalLabel">Choose Your Profile Type</h5>
                            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mb-4">Please select your profile type:</p>
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 mb-2">User <i class="fas fa-user"></i></a>
                            <a href="{{ route('showSignUpForm') }}" class="btn btn-light btn-lg px-5">Artisan <i class="fas fa-paint-brush"></i></a>
                        </div>
                    </div>
                    <script>
                            document.getElementById('colse').addEventListener('click',function(){
                                document.getElementById('profileTypeModal').style.display='none';
                            })
                    </script>
                </div>
            </div>
        </div>
    
        <style>
                                  .section-padding {
    padding: 80px 0;
    /* background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%); */
}

.btn-light {
    background-color: #fff;
    border-color: #fff;
    color: #6a11cb;
    transition: all 0.3s ease;
}
.close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #fff;
    cursor: pointer;
}
.close:hover {
    color: #ddd;
}
.btn-light:hover {
    background-color: #6a11cb;
    border-color: #6a11cb;
    color: #fff;
}

.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - (1.75rem * 2));
}

.modal-content {
    border: none;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

.modal-header {
    background-color: #6a11cb;
    color: #fff;
    border-radius: 10px 10px 0 0;
}

.modal-body {
    background-color: #f8f9fa;
    color: #343a40;
}
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#getStartedBtn').click(function (e) {
            e.preventDefault();
            $('#profileTypeModal').modal('show');
        });
    });
</script>
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