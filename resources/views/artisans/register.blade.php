@extends('layouts.master')

@section('main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

@if(session('success'))
    <x-alert type="success" dismissible="true">
        {{ session('success') }}
    </x-alert>
@endif

@if($errors->any())
    <x-alert type="danger" dismissible="true">
        <strong>Whoops!</strong> There were some problems with your input.
        <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<form method="POST" action="{{ route('artisans.store') }}">
    @csrf
    <!-- Your form fields here -->
</form>

<div class="container-fluid professional-signup">
    <div class="form-container">
        <!-- Left Branding Section -->
        <div class="form-branding">
            <div class="branding-content">
                <a href="{{ route('artisan.login') }}">already have account ?</a>
                <img src="{{ asset('images/logo.jpg') }}" 
                     class="brand-logo" 
                     alt="Professional Logo">
                <h1>Join Our Professional Network</h1>
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-shield-check"></i>
                        <span>Secure Platform</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-network"></i>
                        <span>Business Growth Tools</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users-gear"></i>
                        <span>Professional Community</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="form-content" style="background-color: rgb(227,227,235)">
            <div class="form-stepper">
                <div class="stepper-progress" id="stepperProgress"></div>
                <div class="stepper-step active" data-step="1">1</div>
                <div class="stepper-step" data-step="2">2</div>
            </div>

            <form action="{{ route('artisans.store') }}" method="POST" enctype="multipart/form-data" id="professionalForm">
                @csrf
                
                <!-- Step 1: Personal Information -->
                <div class="form-step active" id="step1">
                    <div class="form-section">
                        <h3><i class="fas fa-user-tie"></i> Personal Information</h3>
                        
                        <!-- Profile Photo Upload -->
                        <div class="form-group">
                            <label>Profile Photo</label>
                            <div class="profile-upload-container">
                                <div class="profile-preview-wrapper">
                                    <div class="profile-preview" id="profilePreview">
                                        <span class="upload-instruction">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>Click to upload</span>
                                        </span>
                                        <img src="" alt="Profile Preview" class="upload-preview">
                                    </div>
                                    <input type="file" 
                                           id="photo" 
                                           name="photo" 
                                           accept="image/*"
                                           required
                                           class="upload-input">
                                </div>
                                <div class="upload-meta">
                                    <div class="upload-hint">JPEG or PNG, Max 2MB</div>
                                    <div class="upload-error" id="photoError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       required
                                       data-validation="name">
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                            <div class="hint">Legal name as per official documents</div>
                        </div>

                        <div class="form-group">
                            <label for="email">Professional Email</label>
                            <div class="input-wrapper">
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       required
                                       data-validation="email">
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Contact Number</label>
                            <div class="input-wrapper">
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       required
                                       pattern="[0-9]{10}"
                                       data-validation="phone">
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="address" 
                                       name="address" 
                                       value="{{ old('address') }}"
                                       required
                                       data-validation="address">
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-navigation">
                        <button type="button" class="btn-next" onclick="validateStep(1)">Next <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 2: Professional Information -->
                <div class="form-step" id="step2">
                    <div class="form-section">
                        <h3><i class="fas fa-briefcase"></i> Professional Details</h3>

                        <div class="form-group">
                            <label for="profession">Primary Profession</label>
                            <div class="input-wrapper">
                                <select id="profession" name="profession" required>
                                    <option value="">Select Profession</option>
                                    <option value="Carpenter">Carpenter</option>
                                    <option value="Electrician">Electrician</option>
                                    <option value="Plumber">Plumber</option>
                                </select>
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="experience">Experience (Years)</label>
                            <div class="input-wrapper">
                                <input type="number" 
                                       id="experience" 
                                       name="experience_years" 
                                       min="1" 
                                       value="{{ old('experience_years') }}"
                                       required>
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bio">Professional Bio</label>
                            <div class="bio-input-container">
                                <textarea id="bio" 
                                          name="bio" 
                                          rows="4"
                                          maxlength="200"
                                          required
                                          placeholder="Describe your professional experience..."
                                          class="bio-input">{{ old('bio') }}</textarea>
                                <div class="bio-footer">
                                    <div class="char-counter">
                                        <span id="charCount">0</span>/200 characters
                                    </div>
                                    <div class="bio-hint">
                                        <i class="fas fa-lightbulb"></i> Minimum 100 characters
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Create Password</label>
                            <div class="input-wrapper">
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       required
                                       data-validation="password">
                                <div class="password-strength-meter">
                                    <div class="strength-bar"></div>
                                </div>
                                <div class="validation-feedback">
                                    <i class="fas fa-check-circle valid-icon"></i>
                                    <i class="fas fa-times-circle invalid-icon"></i>
                                </div>
                            </div>
                            <div class="password-rules">
                                <span data-rule="length">8+ Characters</span>
                                <span data-rule="uppercase">Uppercase</span>
                                <span data-rule="number">Number</span>
                                <span data-rule="special">Special Char</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-navigation">
                        <button type="button" class="btn-prev" onclick="changeStep(1)"><i class="fas fa-arrow-left"></i> Previous</button>
                        <button type="submit" class="btn-submit">Complete Registration <i class="fas fa-check"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Modern Design System */
:root {
    --primary-color: #2b5876;
    --secondary-color: #4e4376;
    --success-color: #22c55e;
    --error-color: #ef4444;
    --text-color: #334155;
    --border-color: #e2e8f0;
    --background-light: #f8fafc;
}

.professional-signup {
    min-height: 100vh;
    background: var(--background-light);
    display: flex;
    align-items: center;
    padding: 2rem;
}

.form-container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    display: grid;
    grid-template-columns: 1fr 1.75fr;
    min-height: 800px;
    overflow: hidden;
}

/* Branding Section */
.form-branding {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 3rem;
    color: white;
    display: flex;
    align-items: center;
}

.branding-content {
    max-width: 400px;
    margin: 0 auto;
}

.brand-logo {
    max-width: 180px;
    margin-bottom: 2rem;
}

.features-list {
    margin-top: 3rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    margin: 1rem 0;
    background: rgba(255,255,255,0.1);
    border-radius: 0.75rem;
    transition: transform 0.3s ease;
}

.feature-item:hover {
    transform: translateX(5px);
}

/* Form Content */
.form-content {
    padding: 3rem;
    position: relative;
}

/* Stepper */
.form-stepper {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    position: relative;
}

.stepper-progress {
    position: absolute;
    height: 2px;
    background: var(--border-color);
    width: 100%;
    z-index: 1;
}

.stepper-progress-active {
    position: absolute;
    height: 2px;
    background: var(--primary-color);
    z-index: 2;
    transition: width 0.3s ease;
}

.stepper-step {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: var(--text-color);
    position: relative;
    z-index: 3;
    transition: all 0.3s ease;
}

.stepper-step.active {
    background: var(--primary-color);
    color: white;
}

/* Form Steps */
.form-step {
    display: none;
    opacity: 0;
    transform: translateX(20px);
    transition: all 0.3s ease-in-out;
}

.form-step.active {
    display: block;
    opacity: 1;
    transform: translateX(0);
}

/* Form Navigation */
.form-navigation {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-next, .btn-prev, .btn-submit {
    padding: 1rem 2rem;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-next, .btn-submit {
    background: var(--primary-color);
    color: white;
}

.btn-prev {
    background: #e2e8f0;
    color: var(--text-color);
}

.btn-next:hover, .btn-submit:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}

.btn-prev:hover {
    background: #d1d5db;
    transform: translateY(-2px);
}

/* Input Groups */
.form-group {
    margin-bottom: 1.5rem;
}

.input-wrapper {
    position: relative;
}

input, select, textarea {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    color: var(--text-color);
}

input:focus, select:focus, textarea:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(43,88,118,0.1);
    outline: none;
}

/* Profile Upload */
.profile-upload-container {
    margin-bottom: 2rem;
}

.profile-preview-wrapper {
    position: relative;
    width: 160px;
    height: 160px;
    margin-bottom: 1rem;
}

.profile-preview {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 2px dashed var(--border-color);
    background: var(--background-light);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
}

.profile-preview:hover {
    border-color: var(--primary-color);
    background: #f1f5f9;
}

.upload-instruction {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #64748b;
    text-align: center;
    padding: 1rem;
}

.upload-instruction i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.upload-preview {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
}

.upload-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

/* Bio Field */
.bio-input-container {
    border: 2px solid var(--border-color);
    border-radius: 0.75rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.bio-input-container:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(43,88,118,0.1);
}

.bio-input {
    width: 100%;
    min-height: 140px;
    padding: 1rem;
    border: none;
    resize: vertical;
    line-height: 1.5;
}

.bio-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 1rem;
    background: var(--background-light);
    border-top: 1px solid var(--border-color);
}

.char-counter {
    font-size: 0.875rem;
    color: #64748b;
}

.bio-hint {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.875rem;
}

/* Validation */
.validation-feedback {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
}

.valid-icon { color: var(--success-color); display: none; }
.invalid-icon { color: var(--error-color); display: none; }

.input-wrapper.valid .valid-icon { display: block; }
.input-wrapper.invalid .invalid-icon { display: block; }

/* Password Strength */
.password-strength-meter {
    height: 4px;
    background: var(--border-color);
    border-radius: 2px;
    margin-top: 0.5rem;
    overflow: hidden;
}

.strength-bar {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
}

.strength-0 { width: 0; background: var(--error-color); }
.strength-1 { width: 25%; background: var(--error-color); }
.strength-2 { width: 50%; background: #f59e0b; }
.strength-3 { width: 75%; background: #3b82f6; }
.strength-4 { width: 100%; background: var(--success-color); }

/* Responsive Design */
@media (max-width: 1024px) {
    .form-container {
        grid-template-columns: 1fr;
        min-height: auto;
    }
    
    .form-branding {
        padding: 2rem;
        text-align: center;
    }
    
    .form-content {
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-preview-wrapper {
        width: 120px;
        height: 120px;
    }
    
    .form-navigation {
        flex-direction: column;
    }
    
    .btn-next, .btn-prev, .btn-submit {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize stepper
    updateStepper(1);

    // Profile Image Preview
    const profilePreview = document.getElementById('profilePreview');
    const uploadInput = document.getElementById('photo');
    const previewImage = profilePreview.querySelector('.upload-preview');
    const photoError = document.getElementById('photoError');

    uploadInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        photoError.textContent = '';
        
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            photoError.textContent = 'Please upload an image file (JPEG/PNG)';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            photoError.textContent = 'File size must be less than 2MB';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            profilePreview.querySelector('.upload-instruction').style.display = 'none';
        }
        reader.readAsDataURL(file);
    });

    // Bio Character Counter
    const bioInput = document.getElementById('bio');
    const charCount = document.getElementById('charCount');
    
    bioInput.addEventListener('input', function() {
        const currentLength = this.value.length;
        charCount.textContent = currentLength;
        charCount.style.color = currentLength >= 200 ? '#ef4444' : 
                              currentLength >= 100 ? '#22c55e' : '#64748b';
    });

    // Password Strength
    const passwordInput = document.getElementById('password');
    const strengthBar = document.querySelector('.strength-bar');

    passwordInput.addEventListener('input', function(e) {
        const password = e.target.value;
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        strengthBar.className = `strength-bar strength-${strength}`;
    });

    // Real-time Validation
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('input', function() {
            validateField(this);
        });
    });
});

function updateStepper(activeStep) {
    const steps = document.querySelectorAll('.stepper-step');
    const progress = document.querySelector('.stepper-progress-active');
    
    // Update step indicators
    steps.forEach((step, index) => {
        if (index < activeStep) {
            step.classList.add('active');
        } else {
            step.classList.remove('active');
        }
    });

    // Update progress bar
    const progressWidth = ((activeStep - 1) / (steps.length - 1)) * 100;
    if (progress) {
        progress.style.width = `${progressWidth}%`;
    }
}

function validateStep(currentStep) {
    const stepElement = document.getElementById(`step${currentStep}`);
    const inputs = stepElement.querySelectorAll('input, select, textarea');
    let isValid = true;

    inputs.forEach(input => {
        validateField(input);
        if (!input.checkValidity()) {
            isValid = false;
        }
    });

    if (isValid) {
        changeStep(currentStep + 1);
    } else {
        alert('Please fill all required fields correctly');
    }
}

function changeStep(newStep) {
    // Hide all steps
    document.querySelectorAll('.form-step').forEach(step => {
        step.classList.remove('active');
    });
    
    // Show current step
    const nextStep = document.getElementById(`step${newStep}`);
    if (nextStep) {
        nextStep.classList.add('active');
        updateStepper(newStep);
    }
}

function validateField(field) {
    const wrapper = field.closest('.input-wrapper');
    if (!wrapper) return;

    wrapper.classList.remove('valid', 'invalid');

    if (field.checkValidity()) {
        wrapper.classList.add('valid');
    } else if (field.value.length > 0) {
        wrapper.classList.add('invalid');
    }
}
</script>
@endsection