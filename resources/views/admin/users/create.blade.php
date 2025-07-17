@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header">
            <h4>Create New User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <!-- Roles (Optional) -->
                <div class="mb-3">
                    <label for="roles" class="form-label">Assign Role</label>
                    <select name="roles[]" class="form-select" multiple>
                        @foreach($roles as $role)
<option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
        </div>
    </div>
</div>
@endsection
