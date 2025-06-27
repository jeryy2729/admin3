@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Login</button>
        <a class="nav-link" href="{{ route('register') }}">{{ __('User') }}</a>
    </form>
</div>
@endsection
