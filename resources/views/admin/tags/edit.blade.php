@extends('admin.layouts.app')

@section('content')
<div class="container-fluid" style="padding-top: 100px;">
    <div class="row min-vh-100">
        <div class="col-md-9 col-sm-8 p-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4">Edit Tag</h2>

                    @if(session('status'))
                        <div class="alert alert-primary mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('tags.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label><strong>Tag Name:</strong></label>
                                <input type="text" name="name" value="{{ old('name', $tag->name) }}" class="form-control" placeholder="Tag Name">
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label><strong>Description:</strong></label>
<textarea name="description" id="description" class="form-control" rows="6">
    {{ old('description', $tag->description ?? '') }}
</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-check mb-4">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" class="form-check-input" id="status" value="1"
                                   {{ old('status', $tag->status) ? 'checked' : '' }}>
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
