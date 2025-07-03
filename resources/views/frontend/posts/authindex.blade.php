@extends('frontend.layouts.main')

@section('main-container')
<div class="container">
    <h2 class="mb-4">Posts List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <a href="{{ route('user.posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Description</th>
                <th>Status</th>
                <th>Approval</th>
        <tbody>
            @forelse($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                    <td>{{ $post->name }}</td>
                    <td>
                        @foreach($post->tags as $tag)
                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ Str::limit($post->description, 50) }}</td>  <!-- Limit description length -->
                    <td>
                        @if($post->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>@if($post->is_approved)
                        <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-secondary">Unapproved</span>
                        @endif
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No posts available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination links -->
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
        // Initialize select2 if you have any dropdowns
        $('select').select2({
            width: '100%'  // Ensure the select box takes full width
        });
    });
</script>
@endpush
