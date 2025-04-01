@extends('layouts.master')
@section('main')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <div class="login-container">
            @if ($errors->any())
            <x-alert type="danger">
                <ul>
                    @foreach ($errors->all() as $item)
                       <li>{{ $item }}</li>
                     @endforeach
                </ul>
            </x-alert>
        @endif
            <h3 class="text-center mb-4"> <i class="fas fa-user-lock"></i> Connexion</h3>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('checklogin') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock"></i> Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('register') }}">Create Account</a>
            </div>
        </div>
    </div>
</body>
</html>

@endsection