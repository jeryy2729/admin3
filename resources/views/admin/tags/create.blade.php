@extends('admin.layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px;"> <!-- Avoid navbar overlap -->
    <div class="row min-vh-100">

        <!-- Main Content -->
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4">Add New Tag</h2>

                    @if(session('status'))
                        <div class="alert alert-danger mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('tags.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><strong>Tag Type:</strong></label>
                                <input type="text" name="name" class="form-control" placeholder="Tag Name">
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
 <div class="form-group col-md-6">
                                <label><strong>Description:</strong></label>
                                <input type="text" name="description" class="form-control" placeholder="Description">
                                @error('description')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-check mb-4">
                            <input type="checkbox" name="status" class="form-check-input" id="status" value="1" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                            
                        <button type="submit" class="btn btn-primary">Submit</button>
                      
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
<!-- 
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
@endpush -->
