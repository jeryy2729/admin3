@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Main Content -->
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0 text-primary fw-bold">🛡️ All Permissions</h2>
                        <a class="btn btn-gradient" href="{{ route('permissions.create') }}">
                            ➕ Add New Permission
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="tags-table" class="table table-bordered table-hover table-striped align-middle shadow-sm">
                            <thead class="bg-gradient text-white">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                <tr>
                                    <td class="text-center text-secondary">{{ $permission->id }}</td>
                                    <td class="fw-semibold text-dark">{{ $permission->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger rounded-pill shadow" onclick="return confirm('Delete this permission?')">
                                                🗑️ Delete
                                            </button>
                                        </form>

                                        <form action="{{ route('permissions.edit', $permission->id) }}" method="GET" style="display:inline;">
                                            <button class="btn btn-sm btn-info text-white rounded-pill shadow">
                                                ✏️ Edit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No permissions found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .dataTables_length,
    .dataTables_filter {
        margin-bottom: 1rem;
    }

    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 5px 10px;
    }

    .select2-container {
        margin-left: 5px;
    }

    /* Gradient background for the header */
    .bg-gradient {
        background: linear-gradient(to right, #4e54c8, #8f94fb);
    }

    .btn-gradient {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        color: #fff;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0, 114, 255, 0.3);
        transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        background: linear-gradient(to right, #0072ff, #00c6ff);
        transform: scale(1.03);
    }

    .table-hover tbody tr:hover {
        background-color: #f1f9ff;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tags-table').DataTable();
    });
</script>
@endpush
