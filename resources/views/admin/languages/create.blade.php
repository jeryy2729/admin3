@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid" style="padding-top: 100px;">
    <div class="row justify-content-center">

        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i> Add New Language</h4>
                </div>

                <div class="card-body px-5 py-4">


                    <form action="{{ route('languages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Language Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold"><i class="fas fa-tag me-1 text-primary"></i> Language Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Language Name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
  <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold"><i class="fas fa-tag me-1 text-primary"></i> Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Enter Language Code" value="{{ old('code') }}">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        
                        <!-- Status -->
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-orange px-4 py-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Save Language
                            </button>
                        </div>
                    </form>
  
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
<!-- jQuery (optional, if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        CKEDITOR.replace('description');
    });
</script>
@endpush
