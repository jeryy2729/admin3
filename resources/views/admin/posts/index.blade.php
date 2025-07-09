@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Posts List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>


 <form method="GET" action="{{ route('posts.index') }}" class="mb-3">
                       @if(request()->has('trashed'))
    <input type="hidden" name="trashed" value="true">
@endif
 <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>                   
<a href="{{ $showTrashed ? route('posts.index') : route('posts.index', ['trashed' => true]) }}" 
   class="btn btn-secondary mb-3">
    {{ $showTrashed ? 'Show Active' : 'Show Trashed' }}
</a>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-blue">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                    @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                
                <th>Category</th>
                <th>Name</th>
 <th>Image</th>
                <th>Tags</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Is_Featured</th>
                                    <th>Approval</th>
                                    <th width="200px">Action</th>            </tr>
        </thead>
        <tbody>
            @forelse($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    
                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                    <td>{{$post->name}}</td>
                                                <td><img src="{{ asset('storage/'.$post->image) }}" style="height: 50px; width: 50px"></td>

                                      <td>
                        @foreach($post->tags as $tag)
                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                                    <td>{!! $post->description !!}</td>
                                    <td>
                                        @if($post->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                     <td>
                                        @if($post->is_featured)
                                            <span class="badge bg-success">Featured</span>
                                        @else
                                            <span class="badge bg-secondary">Not Featured</span>
                                        @endif
                                    </td>
<td>
    @if($post->user_id) {{-- Only show the action if created by a user --}}
        @if($post->is_approved)
            <span class="badge bg-success">Approved</span>
        @else
            <form method="POST" action="{{ route('admin.posts.approve', $post) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm btn-primary">Approve</button>
            </form>
        @endif
    @else
        <span class="text-muted">No Action</span>
    @endif
</td>

                    <td>
                        @if ($showTrashed)
    {{-- Restore Button --}}
    <form action="{{ route('posts.restore', $post) }}" method="POST" style="display: inline;">
        @csrf
        @method('PUT')
        <button class="btn btn-sm btn-success" onclick="return confirm('Restore this post?')">Restore</button>
    </form>

    {{-- Permanent Delete Button --}}
    <form action="{{ route('posts.forceDelete', $post) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this category?')">Erase</button>
    </form>
@else
    {{-- Soft Delete --}}
    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
    </form>

    {{-- Edit --}}
    <form action="{{ route('posts.edit', $post) }}" method="GET" style="display:inline;">
        <button class="btn btn-sm btn-blue">Edit</button>
    </form>
@endif
            @empty
                <tr><td colspan="5">No posts found.</td></tr>
            @endforelse
                                                                  

        </tbody>
    </table>
    <div class="mt-3">
    {{ $posts->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}

</div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Don't use DataTables since we use Laravel's pagination
        $('select').select2({
            width: '100%'
        });
    });
</script>
@endpush
