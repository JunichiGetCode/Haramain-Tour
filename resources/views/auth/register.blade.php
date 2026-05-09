@extends('layouts.auth')

@section('title', 'Registrasi - Haramain Tour')

@section('content')
    <div class="form-header-container">
        <div class="small-logo-container">
            <div class="small-logo"></div>
        </div>
        <h2>{{ __('Buat Akun Baru') }}</h2>
        <p class="form-subtitle">{{ __('Daftar untuk mulai merencanakan perjalanan') }}</p>
    </div>
    
    <form class="login-form" method="POST" action="{{ route('register.post') }}">
        @csrf
        
        <div class="input-group">
            <input type="text" name="name" placeholder="{{ __('Nama lengkap') }}" value="{{ old('name') }}" required autofocus>
            <i class="fa-regular fa-user input-icon"></i>
        </div>
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="input-group">
            <input type="email" name="email" placeholder="{{ __('Alamat email') }}" value="{{ old('email') }}" required>
            <i class="fa-regular fa-envelope input-icon"></i>
        </div>
        @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="input-group">
            <input type="password" name="password" placeholder="{{ __('Kata sandi') }}" required>
            <i class="fa-solid fa-lock input-icon"></i>
        </div>
        @error('password')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="input-group">
            <input type="password" name="password_confirmation" placeholder="{{ __('Konfirmasi kata sandi') }}" required>
            <i class="fa-solid fa-shield-halved input-icon"></i>
        </div>
        
        <button type="submit" class="btn-login">{{ __('Daftar Sekarang') }}</button>
    </form>

    <div class="social-login">
        <div class="social-divider">
            <p>{{ __('atau daftar dengan') }}</p>
        </div>
        <div class="social-icons">
            <a href="{{ route('google.login') }}" class="social-icon-btn"><i class="fa-brands fa-google"></i></a>
        </div>
    </div>
@endsection