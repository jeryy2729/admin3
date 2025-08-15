@extends('admin.layouts.app')

@section('content')
<!-- 
@php
    $isAdmin = auth()->guard('admin')->check();
    $isBlogger = auth()->guard('web')->check() && auth()->user()?->hasRole('blogger');
@endphp -->

<div class="container-fluid py-4">
    @include('components.alerts')

    <div class="card shadow-lg border-0">
        <div class="card-body">
            

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">📂 All Languages</h2>

                @if($isAdmin)
                    <a class="btn btn-success shadow-sm" href="{{ route('languages.create') }}">
                        <i class="fas fa-plus-circle me-1"></i> Add New Language
                    </a>
                @endif
            </div>

            <form method="GET" action="{{ route('languages.index') }}" class="mb-3">
                @if(request()->has('trashed'))
                    <input type="hidden" name="trashed" value="true">
                @endif
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Search languages..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>

           
            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            @if($isAdmin)
                                <th width="200px">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($languages as $language)
                            <tr>
                                <td>{{ $language->id }}</td>
                                <td class="fw-semibold text-info">{{ $language->name }}</td>
                                  <td class="fw-semibold text-info">{{ $language->code }}</td>

                                <td>
                                    @if($language->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                @if($isAdmin)
                                    <td>
                                            {{-- Edit --}}
                                            <a href="{{ route('languages.edit', $language) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('languages.destroy', $language) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this language?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                         </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 6 : 5 }}" class="text-center text-muted">No languages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                </div>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger mt-3">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .btn-primary {
        background-color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-primary:hover {
        background-color: #5a32a3;
    }

    h2 {
        color: #2c3e50;
    }

    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    $(document).ready(function () {
        $('select').select2({ width: '100%' });
    });
</script>
@endpush
