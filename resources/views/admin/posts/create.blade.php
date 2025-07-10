@extends('admin.layouts.app')

@push('styles')
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    h2 {
        color: #343a40;
    }

    .select2-container--default .select2-selection--multiple {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        padding: 0.375rem;
        min-height: 38px;
    }

    .select2-container--default .select2-selection__choice {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 0.25rem 0.5rem;
        margin-top: 4px;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i> Add New Post</h4>
                </div>

        <div class="card-body">
            <h2 class="mb-4"><i class="bi bi-plus-circle me-2 text-primary"></i>Create New Post</h2>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Post Name -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-pencil-square text-primary me-1"></i>Post Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-card-image text-primary me-1"></i>Post Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-folder-fill text-primary me-1"></i>Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags (Select2) -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-tags-fill text-primary me-1"></i>Tags</label>
                    <select name="tags[]" class="form-select select2" multiple required>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tags')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-file-earmark-text text-primary me-1"></i>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="6"></textarea>
                    @error('description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="form-check mb-3">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" checked>
                    <label class="form-check-label" for="status">Active</label>
                </div>

                <!-- Is Featured -->
                <div class="form-check mb-4">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1" checked>
                    <label class="form-check-label" for="is_featured">Featured Post</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i> Create Post
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        // Initialize CKEditor
        CKEDITOR.replace('description');

        // Initialize Select2
        $('.select2').select2({
            placeholder: 'Select tags',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
