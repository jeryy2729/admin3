@extends('admin.layouts.app')

@section('content')

{{-- Admin-only section --}}
@role('admin')
    <a href="{{ route('users.index') }}" class="btn btn-outline-dark mb-3">
        <i class="fas fa-users-cog"></i> Manage Users
    </a>
@endrole

{{-- Blogger-only greeting --}}
@role('blogger')
    <div class="alert alert-info">
        <strong>Welcome Blogger!</strong> You have limited access.
    </div>
@endrole

<div class="container">
    <h2 class="mb-4 text-primary">Posts List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus-circle"></i> Create New Post
    </a>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-3">
        @if(request()->has('trashed'))
            <input type="hidden" name="trashed" value="true">
        @endif
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    {{-- Trashed Toggle --}}
    <a href="{{ $showTrashed ? route('posts.index') : route('posts.index', ['trashed' => true]) }}" 
       class="btn {{ $showTrashed ? 'btn-outline-info' : 'btn-outline-warning' }} mb-3">
        <i class="fas fa-trash"></i> {{ $showTrashed ? 'Show Active' : 'Show Trashed' }}
    </a>

    {{-- Posts Table --}}
    <table class="table table-hover table-bordered bg-white">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Description</th>
                <th>Status</th>
                <th>Approval</th>
                <th width="200px">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                    <td>{{ $post->name }}</td>

                    <td>
                        @forelse($post->tags as $tag)
                            <span class="badge bg-info text-white">{{ $tag->name }}</span>
                        @empty
                            <span class="text-muted">No tags</span>
                        @endforelse
                    </td>

                    <td>{!! \Illuminate\Support\Str::words($post->description, 10, '...') !!}</td>

                    <td>
                        @if($post->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>

                    <td>
                        @if($post->user_id)
                            @if($post->is_approved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                @role('admin')
                                    <form method="POST" action="{{ route('admin.posts.approve', $post->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-check-circle"></i> Approve
                                        </button>
                                    </form>
                                @else
                                    <span class="text-warning">Pending</span>
                                @endrole
                            @endif
                        @else
                            <span class="text-muted">System Generated</span>
                        @endif
                    </td>

                    <td>
                        {{-- Trashed Actions --}}
                        @if ($showTrashed)
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-success" onclick="return confirm('Restore this post?')">
                                    <i class="fas fa-undo"></i> Restore
                                </button>
                            </form>

                            <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this post?')">
                                    <i class="fas fa-trash-alt"></i> Erase
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>

                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $posts->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

@push('scripts')
    {{-- jQuery and Select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('select').select2({ width: '100%' });
        });
    </script>
@endpush
