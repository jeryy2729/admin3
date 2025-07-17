@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Roles -->
                <div class="mb-3">
                    <label for="roles" class="form-label">Assign Roles</label>
                    <select name="roles[]" class="form-select" multiple>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Password (optional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password (Leave blank to keep existing)</label>
                    <input type="password" name="password" class="form-control">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Update User</button>
            </form>
        </div>
    </div>
</div>
@endsection
