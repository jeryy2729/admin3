@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New Post</a>

            <div class="card shadow rounded">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">All Registered Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Verified At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>                @if ($user->email_verified_at)
                    {{ $user->email_verified_at->format('d M Y, h:i A') }}
                @else
                    <span class="text-danger">Not Verified</span>
                @endif
</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No users found.</td>
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
