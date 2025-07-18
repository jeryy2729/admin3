@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid" style="padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i> Create New User</h4>
                    <p class="mb-0 small">Fill in the details to add a new user and assign a role.</p>
                </div>

                <!-- Body -->
                <div class="card-body px-5 py-4">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold"><i class="bi bi-person-fill text-primary me-1"></i> Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill px-4 py-2" placeholder="John Doe" value="{{ old('name') }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope-fill text-primary me-1"></i> Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill px-4 py-2" placeholder="john@example.com" value="{{ old('email') }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold"><i class="bi bi-lock-fill text-primary me-1"></i> Password</label>
                                <input type="password" name="password" class="form-control rounded-pill px-4 py-2" placeholder="********" required>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold"><i class="bi bi-lock-fill text-primary me-1"></i> Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-pill px-4 py-2" placeholder="********" required>
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 mb-3">
<label for="role" class="form-label fw-semibold">
    <i class="bi bi-person-gear text-primary me-1"></i> Assign Role
</label>
                                <select name="role" class="form-select rounded-pill px-4 py-2" required>
                                    <option value="">-- Select Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-orange px-4 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Create User
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .btn-orange {
        background: linear-gradient(135deg, #f96d41, #f9a041);
        color: #fff;
        border: none;
    }
    .btn-orange:hover {
        background: linear-gradient(135deg, #f85c2d, #f78f1e);
        color: #fff;
    }
</style>

@endpush
