@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0 text-primary">All Comments</h2>
                        <span class="badge bg-info text-dark">{{ $comments->total() }} total</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered rounded shadow-sm">
                            <thead class="table-dark text-uppercase">
                                <tr>
                                    <th>#</th>
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
                                        <td><i class="fas fa-user text-info me-1"></i>{{ $comment->user->name ?? 'Unknown' }}</td>
                                        <td><i class="fas fa-book text-warning me-1"></i>{{ $comment->post->name ?? 'Deleted Post' }}</td>
                                        <td>{{ Str::limit($comment->comment, 100) }}</td>
                                        <td><span class="badge bg-secondary">{{ $comment->created_at->diffForHumans() }}</span></td>
                                        <td>
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this comment?')">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <i class="fas fa-info-circle me-1"></i> No comments found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3 d-flex justify-content-center">
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
<!-- Select2 + FontAwesome + Custom -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<style>
    body {
        background-color: #f8f9fa;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    h2 {
        color: #5a3fb9;
        font-weight: bold;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .badge.bg-secondary {
        background-color: #6c757d;
    }

    .card {
        border-radius: 10px;
    }

    .table {
        background-color: #ffffff;
    }

    .table thead th {
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
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
