@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5" style="background: linear-gradient(120deg, #f6d365 0%, #fda085 100%); min-height: 100vh;">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark" style="font-size: 2.2rem;">Create an Account</h2>
                <p class="text-muted">Join Megakit and discover amazing possibilities</p>
            </div>

            <div class="card shadow-lg border-0 rounded-4" style="background-color: #ffffff;">
                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start">
                                    <i class="bi bi-person-fill text-primary"></i>
                                </span>
                                <input type="text" name="name" class="form-control border-0 shadow-sm rounded-end" placeholder="Enter your full name" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start">
                                    <i class="bi bi-envelope-fill text-primary"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-0 shadow-sm rounded-end" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start">
                                    <i class="bi bi-lock-fill text-primary"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-0 shadow-sm rounded-end" placeholder="Create a password" required>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start">
                                    <i class="bi bi-shield-lock-fill text-primary"></i>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control border-0 shadow-sm rounded-end" placeholder="Confirm your password" required>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm text-white">
                                <i class="bi bi-person-plus-fill me-2"></i> Register
                            </button>
                        </div>

                        <!-- Already Have Account -->
                        <div class="text-center">
                            <p class="text-muted mb-2">Already have an account?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login Instead
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
