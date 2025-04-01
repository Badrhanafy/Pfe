{{-- components/alert.blade.php --}}
@props(['type' => 'info', 'dismissible' => true])

<div {{ $attributes->merge(['class' => "alert alert-{$type} fade show", 'role' => 'alert']) }}>
    <div class="d-flex align-items-center">
        <div class="alert-icon flex-shrink-0">
            @switch($type)
                @case('danger')
                    <i class="fas fa-exclamation-triangle me-3"></i>
                    @break
                @case('success')
                    <i class="fas fa-check-circle me-3"></i>
                    @break
                @default
                    <i class="fas fa-info-circle me-3"></i>
            @endswitch
        </div>
        <div class="flex-grow-1">
            {{ $slot }}
        </div>
        @if($dismissible)
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
</div>

<style>
.alert {
    border: 1px solid transparent;
    border-radius: 8px;
    padding: 1rem 1.5rem;
    margin: 1rem 0;
    transition: all 0.3s ease;
}

.alert-danger {
    background: linear-gradient(145deg, #fff5f5, #fee2e2);
    border-color: #fecaca;
    color: #dc2626;
}

.alert-icon i {
    font-size: 1.5rem;
}

.btn-close {
    padding: 0.75rem;
    opacity: 0.7;
    transition: opacity 0.2s ease;
}

.btn-close:hover {
    opacity: 1;
}

.error-list {
    margin: 0.5rem 0 0;
    padding-left: 1.5rem;
}

.error-list li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.5rem;
    transition: all 0.2s ease;
}

.error-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #ef4444;
    font-weight: bold;
}

.error-list li:hover {
    transform: translateX(5px);
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade.show {
    animation: slideIn 0.3s ease-out;
}
</style>