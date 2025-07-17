@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Main Content -->
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">All Tags</h2>
                        <a class="btn btn-primary" href="{{ route('permissions.create') }}">Add New permission</a>
                    </div>

                    <div class="table-responsive">
                        <table id="tags-table" class="table table-bordered table-hover table-striped">


                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                  <td>{{ $permission->name }}</td> 

                                      
    <td>
    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this permission?')">Delete</button>
    </form>

    {{-- Edit --}}
    <form action="{{ route('permissions.edit', $permission->id) }}" method="GET" style="display:inline;">
        <button class="btn btn-sm btn-blue">Edit</button>
    </form>


                        
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No permissions found.</td>
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

        /* Adjust select2 in DataTables */
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 5px 10px;
        }

        .select2-container {
            margin-left: 5px;
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