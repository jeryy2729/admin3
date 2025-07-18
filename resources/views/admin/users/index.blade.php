@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>

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
                                    <th>Actions
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
<td>
      <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
    </form>

    {{-- Edit --}}
    <form action="{{ route('users.edit', $user->id) }}" method="GET" style="display:inline;">
        <button class="btn btn-sm btn-blue">Edit</button>
    </form>
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
