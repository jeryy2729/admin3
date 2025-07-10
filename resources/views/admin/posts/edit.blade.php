@extends('admin.layouts.app')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

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

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
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
    <div class="card shadow-sm">
                      <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i> Edit Post</h4>
                </div>

        <div class="card-body">
            <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Post Name -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-card-text me-1 text-primary"></i>Post Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $post->name) }}" required>
                    @error('name')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-folder-fill me-1 text-primary"></i>Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($post->category_id == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-tags-fill me-1 text-primary"></i>Tags</label>
                    <select name="tags[]" class="form-select select2" multiple required>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Current Image -->
                <div class="form-group mb-4">
                    <label class="form-label fw-semibold"><i class="bi bi-image text-primary me-1"></i>Current Image:</label><br>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-thumbnail mb-2" width="140">
                    @else
                        <p>No image uploaded.</p>
                    @endif
                </div>

                <!-- New Image -->
                <div class="form-group mb-4">
                    <label class="form-label"><i class="bi bi-upload me-1 text-primary"></i>Change Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-file-earmark-text me-1 text-primary"></i>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="6">
                        {{ old('description', $post->description ?? '') }}
                    </textarea>
                    @error('description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="form-check form-switch mb-3">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" class="form-check-input" name="status" id="status" value="1"
                        {{ old('status', $post->status) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>

                <!-- Is Featured -->
                <div class="form-check form-switch mb-4">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" value="1"
                        {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">Featured Post</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i> Update Post
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select tags",
            width: '100%',
            allowClear: true
        });

        CKEDITOR.replace('description');
    });
</script>
@endpush
