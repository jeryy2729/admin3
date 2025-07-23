@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Main Content -->
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0 text-primary">All Roles</h2>
                        <a class="btn btn-success btn-sm px-4 py-2" href="{{ route('roles.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Add New Role
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="tags-table" class="table table-bordered table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col" width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td class="fw-bold text-dark">{{ $role->name }}</td>
                                        <td>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm me-1" onclick="return confirm('Delete this role?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No roles found.</td>
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
    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 1rem;
        }

        /* Adjust select2 in DataTables */
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 5px 10px;
        }

        .select2-container {
            margin-left: 5px;
        }

        table.dataTable td {
            vertical-align: middle;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tags-table').DataTable();
        });
    </script>
@endpush
