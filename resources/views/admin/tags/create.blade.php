@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- ================= Add New Tag Section ================= --}}
            <div class="card shadow-lg border-0 rounded-4 mb-5">
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i> Add New Tag</h4>
                </div>

                <div class="card-body px-5 py-4">
                    <form action="{{ route('tags.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            {{-- Tag Name --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tag me-1 text-primary"></i> Tag Name
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Tag Name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-align-left me-1 text-primary"></i> Description
                                </label>
                                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Status Toggle --}}
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="status">Active</label>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-orange px-4 py-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Save Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ================= Import Tags from Excel ================= --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #41a0f9, #1d68e0);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-file-excel me-2"></i> Import Tags from Excel</h4>
                </div>

                <div class="card-body px-5 py-4">
                    <form action="{{ route('tags.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            {{-- File Upload --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-upload me-1 text-primary"></i> Upload Excel File
                                </label>
                                <input type="file" name="excel_file" class="form-control">
                                @error('excel_file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                                <i class="fas fa-file-import me-1"></i> Import Tags
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('description');
    });
</script>
@endpush
