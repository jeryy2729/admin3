@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5" style="background: linear-gradient(120deg, #ffecd2 0%, #fcb69f 100%); min-height: 100vh;">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark" style="font-size: 2.2rem;">Login to Megakit</h2>
                <p class="text-muted">Enter your credentials to access your account</p>
            </div>

            <div class="card shadow-lg border-0 rounded-4" style="background: #ffffff;">
                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label class="form-label text-dark fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start">
                                    <i class="bi bi-envelope-fill text-primary"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-0 shadow-sm rounded-end" placeholder="e.g. user@example.com" required autofocus>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label class="form-label text-dark fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 rounded-start">
                                    <i class="bi bi-lock-fill text-primary"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-0 shadow-sm rounded-end" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="text-center text-muted my-3">
                            — or —
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="btn btn-outline-warning rounded-pill px-4 shadow-sm">
                                <i class="bi bi-person-plus-fill me-2"></i> Create an Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Optional Forgot Password -->
            {{-- <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none text-secondary small">
                    Forgot Your Password?
                </a>
            </div> --}}
        </div>
    </div>
</div>
@endsection
