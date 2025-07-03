@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">All Comments</h2>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>User</th>
                                    <th>Post</th>
                                    <th>Comment</th>
                                    <th>Posted At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $comment->user->name ?? 'Unknown' }}</td>
                                        <td>{{ $comment->post->name ?? 'Deleted Post' }}</td>
                                        <td>{{ Str::limit($comment->comment, 100) }}</td>
                                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                                        <td>    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this comment?')">Delete</button>
    </form>
</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No comments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $comments->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .btn-blue {
        background-color: rgb(39, 26, 82);
        color: white;
        border: none;
    }

    .btn-blue:hover {
        background-color: #87CDEE;
        color: white;
    }

    h2 {
        color: rgb(90, 63, 185);
    }

    .alert-blue {
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        padding: 10px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('select').select2({ width: '100%' });
    });
</script>
@endpush
