{{-- resources/views/artisan/messages.blade.php --}}
@extends('layouts.master')

@section('main')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Messages</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse ($messages as $message)
                    <li class="list-group-item message-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="sender-info">
                                <button class="btn btn-link dropdown-toggle py-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $message->sender->name }}
                                    <span class="caret"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="display: none;">
                                    <a class="dropdown-item" href="mailto:{{ $message->sender->email }}">
                                        <i class="fas fa-envelope text-primary"></i> Email
                                    </a>
                                    <a class="dropdown-item" href="tel:{{ $message->sender->phone }}">
                                        <i class="fas fa-phone text-success"></i> Phone
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="email-link">
                                <a href="mailto:{{ $message->sender->email }}?cc={{ $message->receiver->email }}&subject=Re:%20{{ urlencode($message->message) }}&body=Hi%20{{ $message->sender->name }}%2C%0A%0A{{ $message->message }}%0A%0ABest%20regards" class="text-muted">{{ $message->sender->email }}</a>
                            </div>
                        </div>
                        <div class="message-time">
                            <i class="fas fa-clock text-muted"></i> {{ $message->created_at->format('M d, Y h:i A') }}
                        </div>
                        <p class="mt-2 message-content">{{ $message->message }}</p>
                    </li>
                @empty
                    <li class="list-group-item text-center">
                        <h5>No messages found.</h5>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    <style>
        .message-item {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        .message-item:last-child {
            border-bottom: none;
        }
        .sender-info {
            display: flex;
            align-items: center;
        }
        .dropdown-toggle {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        .dropdown-toggle:hover {
            text-decoration: underline;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-top: 10px;
        }
        .dropdown-item {
            padding: 10px 20px;
            color: #212529;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .caret {
            margin-left: 5px;
            border-top-color: currentColor;
        }
        .email-link {
            margin-left: auto;
        }
        .message-time {
            color: #6c757d;
        }
        .message-content {
            font-size: 1rem;
            color: #212529;
        }
    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Show dropdown menu when hovering over the dropdown toggle
        $('.dropdown-toggle').hover(
            function() {
                $(this).next('.dropdown-menu').show();
            },
            function() {
                $(this).next('.dropdown-menu').hide();
            }
        );

        // Keep the dropdown menu visible when hovering over it
        $('.dropdown-menu').hover(
            function() {
                $(this).show();
            },
            function() {
                $(this).hide();
            }
        );
    });
</script>
@endsection