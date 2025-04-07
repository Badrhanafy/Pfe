@extends('layouts.artisan')

@section('artisanWorld')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<section class="professional-profile">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="cover-photo">
            <div class="profile-badge">Verified Professional</div>
            
        </div>
        <div class="profile-intro">
            <div class="profile-avatar">
                <img src="{{ $artisan->photo ? asset('storage/' . $artisan->photo) : asset('images/avatar.avif') }}" alt="{{ $artisan->name }}" class="avatar-img">

                <span class="online-status"></span>
            </div>
            <div class="profile-meta mt-3">
                <h1 class="profile-name ">{{ $artisan->name }}</h1>
                <div class="profile-profession " style="position:relative;top:10px">{{ $artisan->profession }}</div>
                <div class="profile-location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $artisan->address }}
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-content">
        <!-- Left Column -->
        <div class="profile-sidebar">
            <div class="profile-widget">
                <h3 class="widget-title">Professional Summary</h3>
                <a href="{{ route('Messagebox', $artisan->id) }}" class="bg-danger">View Messages</a>
                <ul class="stats-list">
                    <li>
                        <i class="fas fa-briefcase"></i>
                        <span>{{ $artisan->experience_years }}+ years experience</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>{{ $artisan->completed_projects ?? '0' }} projects completed</span>
                    </li>
                </ul>
            </div>

            <div class="profile-widget">
                <h3 class="widget-title">Contact Information</h3>
                <ul class="contact-list">
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ $artisan->phone }}">{{ $artisan->phone }}</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $artisan->email }}">{{ $artisan->email }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right Column -->
        <div class="profile-main">
            <!-- About Section -->
            <section class="profile-section">
                <h2 class="section-title"><i class="fas fa-user-tie"></i> About Me</h2>
                <p class="profile-bio">{{ $artisan->bio ?? "no bio " }}</p>
            </section>

            <!-- Experience Section -->
            <section class="profile-section">
                <h2 class="section-title"><i class="fas fa-chart-line"></i> Professional Experience</h2>
                <div class="experience-details">
                    <div class="experience-item">
                        <h4>Years of Experience</h4>
                        <div class="experience-value">{{ $artisan->experience_years }} Years</div>
                    </div>
                    <div class="experience-item">
                        <h4>Specialization</h4>
                        <div class="experience-value">{{ $artisan->profession }}</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<style>
/* Keep all previous CSS styles except skills-related styles */
.professional-profile {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.profile-header {
    position: relative;
    margin-bottom: 100px;
}

.cover-photo {
    height: 250px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: 15px 15px 0 0;
    position: relative;
}

/* Remove skills-grid and skill-card styles */
.experience-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.experience-item {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.experience-item h4 {
    color: #6b7280;
    margin-bottom: 10px;
    font-size: 1rem;
}

.experience-value {
    font-size: 1.5rem;
    color: #1f2937;
    font-weight: 600;
}.professional-profile {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Profile Header */
.profile-header {
    position: relative;
    margin-bottom: 100px;
}

.cover-photo {
    height: 250px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: 15px 15px 0 0;
    position: relative;
}

.profile-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #fff;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
    box-shadow: 0 3px 15px rgba(0,0,0,0.1);
}

.profile-intro {
    position: absolute;
    bottom: -75px;
    left: 50px;
    right: 50px;
    display: flex;
    align-items: flex-end;
    gap: 30px;
}

.profile-avatar {
    position: relative;
    width: 150px;
}

.avatar-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 5px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.online-status {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #10b981;
    border: 3px solid white;
}

.profile-meta {
    margin-bottom: 20px;
}

.profile-name {
    font-size: 2.5rem;
    margin-bottom: 5px;
    color: #1f2937;
}

.profile-profession {
    font-size: 1.2rem;
    color: #6b7280;
    margin-bottom: 10px;
}

.profile-location {
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Profile Content Layout */
.profile-content {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    padding: 0 50px;
}

/* Sidebar Styles */
.profile-widget {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.widget-title {
    font-size: 1.1rem;
    color: #1f2937;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f3f4f6;
}

.rating {
    margin-bottom: 20px;
}

.stars {
    --percent: calc(var(--rating) / 5 * 100%);
    display: inline-block;
    font-size: 1.2rem;
    position: relative;
}

.stars::before {
    content: '★★★★★';
    color: #e5e7eb;
}

.stars::after {
    content: '★★★★★';
    position: absolute;
    left: 0;
    top: 0;
    width: var(--percent);
    overflow: hidden;
    color: #f59e0b;
}

.stats-list li {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
}

/* Skills Grid */
.skills-grid {
    display: grid;
    gap: 15px;
}

.skill-card {
    display: flex;
    align-items: center;
    padding: 15px;
    background: white;
    border-radius: 10px;
    transition: transform 0.2s ease;
}

.skill-card:hover {
    transform: translateY(-3px);
}

.skill-icon {
    width: 40px;
    height: 40px;
    background: #6366f1;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
}

.skill-experience {
    width: 100%;
    position: relative;
    height: 5px;
    background: #f3f4f6;
    border-radius: 3px;
    margin-top: 8px;
}

.experience-bar {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    background: #6366f1;
    border-radius: 3px;
}

/* Portfolio Grid */
.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.portfolio-item {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    aspect-ratio: 1/1;
}

.portfolio-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.portfolio-overlay {
    position: absolute;
    bottom: -100%;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 20px;
    transition: bottom 0.3s ease;
}

.portfolio-item:hover .portfolio-overlay {
    bottom: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-content {
        grid-template-columns: 1fr;
        padding: 0 20px;
    }
    
    .profile-intro {
        flex-direction: column;
        align-items: center;
        text-align: center;
        left: 20px;
        right: 20px;
    }
    
    .avatar-img {
        width: 120px;
        height: 120px;
    }
}

/* Keep other existing styles */
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Portfolio Hover Effect (if keeping portfolio)
    document.querySelectorAll('.portfolio-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.querySelector('.portfolio-overlay').style.bottom = '0';
        });
        
        item.addEventListener('mouseleave', function() {
            this.querySelector('.portfolio-overlay').style.bottom = '-100%';
        });
    });
});
</script>
@endsection