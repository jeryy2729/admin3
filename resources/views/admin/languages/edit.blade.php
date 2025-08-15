@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid" style="padding-top: 100px;">
    <div class="row justify-content-center">

        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-edit me-2"></i> Edit Language</h4>
                </div>

                <!-- Body -->
                <div class="card-body px-5 py-4">


                    <form action="{{ route('languages.update', $language) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Language Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold"><i class="fas fa-tag me-1 text-primary"></i> Language Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $language->name) }}" placeholder="Enter Language Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                   <div class="row">
                            <!-- Language Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold"><i class="fas fa-tag me-1 text-primary"></i> Code</label>
                                <input type="text" name="code" class="form-control" value="{{ old('code', $language->code) }}" placeholder="Enter Language Name">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
        
                        <!-- Status Switch -->
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', $language->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-orange px-4 py-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Update Language
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
<!-- jQuery (needed for CKEditor events if required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        // Initialize CKEditor for description
        CKEDITOR.replace('description');
    });
</script>
@endpush
