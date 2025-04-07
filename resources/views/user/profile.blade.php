@extends('layouts.master')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #7c3aed;
            --secondary: #4f46e5;
            --accent: #ec4899;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4ff, #fdf2f8);
            min-height: 100vh;
            
        }

        .profile-card {
            max-width: 1200px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 2fr;
            animation: cardEntrance 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes cardEntrance {
            0% { opacity: 0; transform: scale(0.9) translateY(50px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        .profile-sidebar {
            background: linear-gradient(160deg, var(--primary), var(--secondary));
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .avatar-wrapper {
            width: 180px;
            height: 180px;
            margin: 0 auto 2rem;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .avatar-wrapper:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-main {
            padding: 3rem;
            position: relative;
        }

        .profile-badge {
            background: linear-gradient(45deg, var(--accent), #f472b6);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .info-list {
            display: grid;
            gap: 1.2rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(249, 250, 251, 0.8);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .edit-btn {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3);
        }

        @media (max-width: 768px) {
            .profile-card {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                padding: 2rem 1rem;
            }
            
            .avatar-wrapper {
                width: 120px;
                height: 120px;
            }
        }
        /* modal styling */
        /* Add these new styles */
        .modal-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .modal-entrance {
            animation: modalEnter 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modalEnter {
            0% { opacity: 0; transform: translateY(50px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        .form-label {
            color: var(--primary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
            outline: none;
        }

        .avatar-upload {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
            cursor: pointer;
        }

        .avatar-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .avatar-upload:hover .avatar-preview {
            transform: scale(1.05);
        }

        .upload-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--accent);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
        }

        .btn-update {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
        }
        /* alert style */

        .alert-glass {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
    </style>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success alert-glass" style="background-color:#D8F6CE;max-width: 800px; margin: 1rem auto; padding: 1.5rem; border-radius: 16px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); opacity: 1; transition: opacity 0.5s ease, transform 0.5s ease;">
        <div style="display: flex; align-items: center;" >
            <div style="background: linear-gradient(45deg, var(--primary), var(--secondary)); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                <i class="fas fa-check" style="color: white; font-size: 1.2rem;"></i>
            </div>
            <div>
                <h4 style="margin: 0 0 0.5rem 0; font-weight: 600;">Success!</h4>
                <p style="margin: 0; font-size: 1rem;">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-glass" style="max-width: 800px; margin: 1rem auto; padding: 1.5rem; border-radius: 16px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); opacity: 1; transition: opacity 0.5s ease, transform 0.5s ease;">
        <div style="display: flex; align-items: center;">
            <div style="background: linear-gradient(45deg, var(--accent), #f472b6); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                <i class="fas fa-exclamation-circle" style="color: white; font-size: 1.2rem;"></i>
            </div>
            <div>
                <h4 style="margin: 0 0 0.5rem 0; font-weight: 600;">Error</h4>
                <ul style="margin: 0; padding-left: 1rem; font-size: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-glass modal-content modal-entrance">
                <div class="modal-header" style="background: linear-gradient(160deg, var(--primary), var(--secondary)); border-radius: 24px 24px 0 0;">
                    <h3 class="modal-title text-white" id="editModalLabel">Edit Profile</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="profileForm" action="{{ route('profileUpdate', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="text-center mb-4">
                            <div class="avatar-upload">
                                <img id="avatarPreview" src="{{ asset('storage/photos/' . (Auth::user()->progilePhoto ?? 'default-avatar.png')) }}" class="avatar-preview" alt="Avatar Preview">
                                <div class="upload-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <input type="file" id="avatarInput" name="profile_photo" class="d-none" accept="image/*">
                            </div>
                        </div>
                    
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" name="gender"  value="{{ Auth::user()->gender }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">date of Bitrh</label>
                                <input type="text" class="form-control" name="date_of_birth"  value="{{ Auth::user()->date_of_birth }}">
                            </div>
                        </div>
                    
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>

    <div class="profile-card">
        @if($errors->any())
    <div class="alert alert-danger alert-glass" style="max-width: 800px; margin: 1rem auto;">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <div class="profile-sidebar">
            <div class="avatar-wrapper">
                <img src="{{ asset('storage/photos/' . Auth::user()->progilePhoto) }}" alt="Profile Image">
            </div>
           <div class="" style="display:flex;flex-direction: column">
            <div class="profile-badge float-start " style="width:15%">
                <span>{{ Auth::user()->gender==="male"? "Mr" :"Miss" }}</span>
                
            </div>
            <h2 class="text-white mb-2">{{ Auth::user()->name }}</h2>
           </div>
            
        </div>
        
        <div class="profile-main">
            <button class="edit-btn">
                <i class="fas fa-pencil-alt"></i>
                Edit Profile
            </button>
            
            <div class="stats-grid">
                <div class="stat-item ">
                    <div class="stat-value">{{ Str::limit(Auth::user()->created_at, 10, '') ?? "no time" }}</div>
                    <div class="stat-label">Last seen</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ Auth::user()->updated_at }}</div>
                    <div class="stat-label">Last update</div>
                </div>
                
            </div>
            
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Email</div>
                        <div class="font-medium">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Phone</div>
                        <div class="font-medium">{{ Auth::user()->phone }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Location</div>
                        <div class="font-medium">{{ Auth::user()->address }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Date of Birth</div>
                        <div class="font-medium">{{ Auth::user()->date_of_birth }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Avatar Upload Preview
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('avatarPreview').src = reader.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    // Animate modal on show
    const editModal = new bootstrap.Modal('#editModal');
    document.querySelector('.edit-btn').addEventListener('click', () => {
        editModal.show();
    });

    // Form submission handling
    document.getElementById('profileForm').addEventListener('submit', function(e) {
       // e.preventDefault();
        // Add your form submission logic here
        console.log('Form submitted');
        editModal.hide();
    });


    /////////// deal with alert 

    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss success alerts
        const successAlerts = document.querySelectorAll('.alert-success');
        successAlerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 3000); // Dismiss after 3 seconds
        });

        // Auto-dismiss error alerts
        const errorAlerts = document.querySelectorAll('.alert-danger');
        errorAlerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000); // Dismiss after 5 seconds
        });
    });
</script>

</html>
@endsection