@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid" style="padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i> Add New Role</h4>
                </div>

                <!-- Body -->
                <div class="card-body px-5 py-4">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Role Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tag me-1 text-primary"></i> Name
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Role Name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Permissions Checkbox List -->
<div class="col-md-12 mb-3">
    <label class="form-label fw-semibold">
        <i class="fas fa-shield-alt me-1 text-success"></i> Assign Permissions
    </label>

    <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-md-4 mb-2">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="permissions[]" 
                        value="{{ $permission->id }}" 
                        id="permission-{{ $permission->id }}">
                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    @error('permissions')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
s

                            <!-- Permissions Multi-select -->
                            <!-- <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-shield-alt me-1 text-success"></i> Assign Permissions
                                </label>
                                <select name="permissions[]" class="form-control select2" multiple>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                                @error('permissions')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> -->

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-orange px-4 py-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2({
            placeholder: 'Select permissions',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
