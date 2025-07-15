<!-- @extends('layouts.app') -->

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
        <div class="card-body text-center">
            <h2 class="mb-3 text-primary">Verify Your Email Address</h2>
            <p class="mb-4">Before proceeding, please check your email for a verification link.</p>

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="d-grid gap-2 mb-3">
                @csrf
                <button type="submit" class="btn btn-outline-primary w-100">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="d-grid gap-2">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
