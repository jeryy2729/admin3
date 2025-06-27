@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" placeholder="Full Name" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
        </div>
        <button class="btn btn-success">Register</button>
    </form>
</div>
@endsection
