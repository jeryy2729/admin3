@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid" style="padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit User</h4>
                    <p class="mb-0 small">Update user details and assign a new role if needed.</p>
                </div>

                <!-- Body -->
                <div class="card-body px-5 py-4">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold"><i class="bi bi-person-fill text-primary me-1"></i> Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill px-4 py-2" value="{{ old('name', $user->name) }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope-fill text-primary me-1"></i> Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill px-4 py-2" value="{{ old('email', $user->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold"><i class="bi bi-lock-fill text-primary me-1"></i> New Password</label>
                                <input type="password" name="password" class="form-control rounded-pill px-4 py-2" placeholder="Leave blank to keep current password">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold"><i class="bi bi-lock-fill text-primary me-1"></i> Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-pill px-4 py-2" placeholder="Confirm new password">
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 mb-3">
<label for="role" class="form-label fw-semibold">
    <i class="bi bi-person-gear text-primary me-1"></i> Assign Role
</label>
                                <select name="role" class="form-select rounded-pill px-4 py-2" required>
                                    <option value="">-- Select Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-orange px-4 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Update User
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
