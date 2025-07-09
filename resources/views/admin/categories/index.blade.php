@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row min-vh-100">
        
        <!-- Sidebar -->
        <!-- <div class="col-md-3 col-sm-4 bg-light p-4 shadow-sm" style="border-right: 1px solid #dee2e6;">
            <h5 class="mb-4 text-uppercase" style="color: #f96d41;">Admin Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link text-dark {{ request()->is('categories') ? 'fw-bold' : '' }}"><i class="fas fa-list-alt me-1"></i>Categories</a>
                </li> -->
                <!-- Add other links here -->
            <!-- </ul>
        </div> -->

        <!-- Main Content -->
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">All Categories</h2>
                        <a class="btn btn-primary" href="{{ route('categories.create') }}">Add New Category</a>
                    </div>
                                        <form method="GET" action="{{ route('categories.index') }}" class="mb-3">
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


 <a href="{{ $showTrashed ? route('categories.index') : route('categories.index', ['trashed' => true]) }}" 
       class="btn btn-secondary mb-3">
        {{ $showTrashed ? 'Show Active' : 'Show Trashed' }}
    </a>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-blue">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                    @endif

                    <div class="table-responsive">
                       <table class="table table-bordered table-hover">

                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>image</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    
                            <td><img src="{{ asset('storage/'.$category->image) }}" style="height: 50px; width: 50px"></td>
                            
                                    <td>{!! $category->description !!}</td>
                                    <td>
                                        @if($category->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                   
              
                 
                                    <td>
                                      @if ($showTrashed)
    {{-- Restore Button --}}
    <form action="{{ route('categories.restore', $category) }}" method="POST" style="display: inline;">
        @csrf
        @method('PUT')
        <button class="btn btn-sm btn-success" onclick="return confirm('Restore this category?')">Restore</button>
    </form>

    {{-- Permanent Delete Button --}}
    <form action="{{ route('categories.forceDelete', $category) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this category?')">Erase</button>
    </form>
@else
    {{-- Soft Delete --}}
    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
    </form>

    {{-- Edit --}}
    <form action="{{ route('categories.edit', $category) }}" method="GET" style="display:inline;">
        <button class="btn btn-sm btn-blue">Edit</button>
    </form>
@endif

                         </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
    {{ $categories->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}

</div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

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
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        // Don't use DataTables since we use Laravel's pagination
        $('select').select2({
            width: '100%'
        });
    });
</script>
@endpush
