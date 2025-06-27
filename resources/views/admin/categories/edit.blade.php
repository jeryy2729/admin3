@extends('admin.layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px;"> <!-- Adjust spacing to avoid navbar overlap -->
    <div class="row min-vh-100">
        
        <!-- Sidebar -->
        <!-- <div class="col-md-3 col-sm-4 bg-light p-4 shadow-sm" style="border-right: 1px solid #dee2e6;">
            <h5 class="mb-4 text-uppercase" style="color: #f96d41;">Admin Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link text-dark"><i class="fas fa-list-alt me-1"></i>Categories</a>
                </li> -->
                <!-- Add more nav items as needed -->
            <!-- </ul>
        </div> -->

        <!-- Main Content -->
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4">Edit Category</h2>

                    @if(session('status'))
                        <div class="alert alert-primary mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><strong>Category Name:</strong></label>
                                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" placeholder="Category Name">
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label><strong>Description:</strong></label>
                                <input type="text" name="description" value="{{ old('description', $category->description) }}" class="form-control" placeholder="Description">
                                @error('description')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-check mb-4">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ old('status', $category->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Is Active</label>
                            @error('status')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    
                    </form>
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
    }
</style>
@endpush 
