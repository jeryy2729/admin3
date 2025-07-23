@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="text-dark fw-bold">All Registered Users</h2>
                <a href="{{ route('users.create') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-person-plus-fill me-1"></i> Create New User
                </a>
            </div>

            <div class="card border-0 shadow rounded-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4">
                    <h5 class="mb-0 fw-semibold">User List</h5>
                </div>
                <div class="card-body bg-light-subtle rounded-bottom-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Verified At</th>
                                    <th width="180px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->email_verified_at)
                                            <span class="badge bg-success">
                                                {{ $user->email_verified_at->format('d M Y, h:i A') }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger">Not Verified</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($user->roles->isNotEmpty())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this user?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>

                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary ms-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                        @else
                                            <span class="text-muted fst-italic">No Action</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div> <!-- card-body -->
            </div> <!-- card -->

        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container-fluid -->
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush
