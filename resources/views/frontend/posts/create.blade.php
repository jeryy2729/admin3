@extends('frontend.layouts.main')

@push('styles')
<!-- ✅ Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    h2 { color: #f96d41; font-weight: bold; }
    .form-label { font-weight: 500; color: #495057; }

    .select2-container--default .select2-selection--multiple {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        padding: 0.375rem;
        min-height: 42px;
    }

    .select2-selection__choice {
        background-color: #0d6efd !important;
        color: white;
        border: none;
        border-radius: 0.375rem;
        padding: 0.25rem 0.5rem;
        margin-top: 4px;
    }

.card-header-custom {
    background: linear-gradient(135deg, #f96d41, #f9a041);
    color: white;
    border-radius: 0.5rem 0.5rem 0 0;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* optional */
}


    .btn-gradient {
        background: linear-gradient(135deg, #198754, #28c76f);
        color: white;
        font-weight: bold;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #28c76f, #198754);
    }
</style>
@endpush

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
         <x-breadcrumbs :items="[
    'Posts' => route('frontend.authpost'),
    __('messages.create_post') => ''
]" />

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-light">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header card-header-custom py-3 px-4">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Create New Post</h2>
                    </div>
                    <div class="card-body px-4 py-5">
                        @if(session('status'))
                            <div class="alert alert-danger mb-3">{{ session('status') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-circle me-1"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('user.posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                    <label class="form-label"><i class="fas fa-heading me-1"></i> Post Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                    <label class="form-label"><i class="fas fa-image me-1"></i> Post Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                    <label class="form-label"><i class="fas fa-folder-open me-1"></i> Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                    <label class="form-label"><i class="fas fa-tags me-1"></i> Tags</label>
                                <select name="tags[]" class="form-select select2" multiple required>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                    <label class="form-label"><i class="fas fa-align-left me-1"></i> Description</label>
                                <textarea name="description" id="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                            </div>
                {{-- Status --}}
                <div class="form-check mb-4">
                    <input type="checkbox" name="status" class="form-check-input" id="status" value="1" checked>
                    <label class="form-check-label" for="status"><i class="fas fa-toggle-on me-1"></i> Active</label>
                </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-gradient px-4 py-2 rounded-pill">
                                    <i class="fas fa-save me-1"></i> Create Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> {{-- end col --}}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- ✅ jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ✅ Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- ✅ CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select tags",
            allowClear: true,
            width: '100%'
        });

        // Initialize CKEditor
        if (typeof CKEDITOR !== 'undefined' && document.getElementById('description')) {
            CKEDITOR.replace('description');
        }
    });
</script>
@endpush
