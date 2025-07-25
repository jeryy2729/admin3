@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white rounded-top-4">
                    <h4 class="mb-0">
                        <i class="fas fa-user me-2"></i> Edit Profile
                    </h4>
                </div>
                <div class="card-body bg-light rounded-bottom-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $admin->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password <small class="text-muted">(optional)</small></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn  w-100 rounded-pill">
                            <i class="fas fa-save me-2"></i> Update Profile
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<!-- Select2 + FontAwesome + Custom -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<style>

    .card-header{
background-color:#b42290    }

    .btn{
background-color: #ec3dc9   }
</style>
@endpush
