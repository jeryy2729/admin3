@extends('admin.layouts.app')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Optional: custom styling -->
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
<div class="container">
    <h2 class="mb-4">Edit Post</h2>
<form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">

        @csrf
        @method('PUT')

<div class="mb-3">
    <label class="form-label">Post Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $post->name) }}" required>
    @error('name')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($post->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <select name="tags[]" class="form-select select2" multiple required>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) selected @endif>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-4">
    <label><strong>Current Image:</strong></label><br>
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Category Image" width="120" class="mb-2">
    @else
        <p>No image uploaded.</p>
    @endif
</div>

<div class="form-group mb-4">
    <label><strong>Change Image:</strong></label>
    <input type="file" name="image" class="form-control">
    @error('image')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>
  <div class="form-group col-md-6">
                                <label><strong>Description:</strong></label>
<textarea name="description" id="description" class="form-control" rows="6">
    {{ old('description', $post->description ?? '') }}
</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
</div>

                        <div class="form-group form-check mb-4">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ old('status', $post->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Is Active</label>
                            @error('status')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
  <div class="form-group form-check mb-4">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Is Featured</label>
                            @error('is_featured')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
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
