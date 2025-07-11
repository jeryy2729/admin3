@extends('layouts.app')

@push('styles')
<style>
    body {
        background: #f4f6f9;
    }

    .login-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        background: #ffffff;
    }

    .login-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }

    .form-control {
        border-radius: 0.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 0.5rem;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }

    .form-check-label {
        font-weight: 400;
        color: #555;
    }

    .forgot-link {
        font-size: 0.9rem;
        color: #007bff;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-card">
                <div class="text-center login-title">{{ __('Admin Login') }}</div>

                <form method="POST" action="{{ route('admin.submit.login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>

                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>

                    {{-- Forgot Password --}}
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
