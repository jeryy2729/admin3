@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Login</h2>
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Email" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary rounded-pill">Login</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary rounded-pill">Create an Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
