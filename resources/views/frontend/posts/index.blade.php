@extends('frontend.layouts.main')

@section('main-container')
<div class="container">
    <h2 class="mb-4">Posts List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <a href="{{ route('user.posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>


 <form method="GET" action="{{ route('user.posts.index') }}" class="mb-3">
                       

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
 
                <th>Tags</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                <th>Approval</th>  
                                </tr>
        </thead>
        <tbody>
            @forelse($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    
                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                    <td>{{$post->name}}
                                      <td>
                        @foreach($post->tags as $tag)
                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                        @endforeach
                    </td>
   <td>{{ $post->description }}</td>
                                    <td>
                                        @if($post->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
  <td> @if($post->is_approved)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-secondary">Unapproved</span>
                                        @endif
                                    </td>
                    <td>
                    
            @empty
                <tr><td colspan="5">No posts found.</td></tr>
            @endforelse
                                                                    

        </tbody>
    </table>
    <div class="mt-3">

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
