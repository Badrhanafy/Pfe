@extends('layouts.master')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }

        .registration-container {
            max-width: 1200px;
            margin: 2rem auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
            background: white;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-image {
            background: linear-gradient(rgba(13, 110, 253, 0.85), rgba(13, 110, 253, 0.85)),
                        url('https://source.unsplash.com/random/600x800?office');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-content {
            padding: 3rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 4;
            transition: all 0.3s ease;
        }

        .form-control {
            padding-left: 40px;
            height: 45px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
            border-color: #0d6efd;
        }

        .form-title {
            font-weight: 600;
            margin-bottom: 2rem;
            color: #2c3e50;
        }

        .btn-register {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .required-asterisk::after {
            content: "*";
            color: #dc3545;
            margin-left: 3px;
        }

        .alert {
            margin-top: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="row g-0">
            <!-- Left Side (Image + Text) -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="form-image">
                    <h2 class="display-5 mb-4">Join Our Professional Community</h2>
                    <p class="lead">
                        <i class="fas fa-check-circle me-2"></i>Secure registration process<br>
                        <i class="fas fa-check-circle me-2"></i>Professional networking opportunities<br>
                        <i class="fas fa-check-circle me-2"></i>24/7 customer support
                    </p>
                </div>
            </div>

            <!-- Right Side (Form) -->
            <div class="col-lg-6">
                <div class="form-content">
                    <h3 class="form-title">Create Account <i class="fas fa-user-plus text-primary ms-2"></i></h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('usersave') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                    
                                <div class="input-group">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                    
                                <div class="input-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                    
                                <div class="input-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <div class="input-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="file" name="progilePhoto" class="form-control">
                                </div>
                            </div>
                    
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <i class="fas fa-phone"></i>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                </div>
                    
                                <div class="input-group">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input type="text" name="address" class="form-control" placeholder="Full Address">
                                </div>
                    
                                <div class="input-group">
                                    <i class="fas fa-user-tag"></i>
                                    <select name="role" class="form-select" required>
                                        <option value="user">Standard User</option>
                                        <option value="admin">Administrator</option>
                                    </select>
                                </div>
                                
                                <!-- Gender Field -->
                                <div class="input-group">
                                    <i class="fas fa-venus-mars"></i>
                                    <select name="gender" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                        <option value="prefer_not_to_say">Prefer Not to Say</option>
                                    </select>
                                </div>
                                
                                <!-- Date of Birth Field -->
                                <div class="input-group">
                                    <i class="fas fa-birthday-cake"></i>
                                    <input type="date" name="date_of_birth" class="form-control" required>
                                </div>
                    
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-register">
                                        Complete Registration <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    
                        <p class="text-muted mt-4 text-center">
                            Already have an account? 
                            <a href="{{ route('loginform') }}" class="text-decoration-none text-primary">Sign In</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection