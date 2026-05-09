@extends('layouts.auth')

@section('title', request('admin') ? 'Login Admin - Haramain Tour' : 'Login - Haramain Tour')

@section('content')
    <div class="form-header-container">
        <div class="small-logo-container">
            @if(request('admin'))
                <i class="fa-solid fa-shield-halved" style="color: var(--navy-color); font-size: 1.8rem;"></i>
            @else
                <div class="small-logo"></div>
            @endif
        </div>
        <h2>{{ request('admin') ? __('Admin Area') : __('Selamat Datang!') }}</h2>
        <p class="form-subtitle">{{ request('admin') ? __('Masuk dengan kredensial admin') : __('Masuk ke akun Anda untuk melanjutkan') }}</p>
    </div>
    
    <form class="login-form" method="POST" action="{{ route('login.post') }}">
        @if(request('admin'))
            <input type="hidden" name="admin" value="1">
        @endif
        @csrf
        
        <div class="input-group">
            <input type="email" name="email" placeholder="{{ __('Alamat email') }}" value="{{ old('email') }}" required autofocus>
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
        
        <div class="forgot-password">
            <a href="#">{{ __('Lupa kata sandi?') }}</a>
        </div>

        <button type="submit" class="btn-login">{{ __('Masuk') }}</button>
    </form>

    <div class="social-login">
        <div class="social-divider">
            <p>{{ __('atau masuk dengan') }}</p>
        </div>
        <div class="social-icons">
            <a href="{{ route('google.login') }}" class="social-icon-btn"><i class="fa-brands fa-google"></i></a>
        </div>
    </div>
@endsection