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
            <div class="mb-3 d-flex justify-content-end">
    <form action="{{ route('categories.export') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fas fa-file-export me-1"></i> Export Categories
        </button>
    </form>
</div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">📂 All Categories</h2>

                @if($isAdmin)
                    <a class="btn btn-success shadow-sm" href="{{ route('categories.create') }}">
                        <i class="fas fa-plus-circle me-1"></i> Add New Category
                    </a>
                @endif
            </div>

            <form method="GET" action="{{ route('categories.index') }}" class="mb-3">
                @if(request()->has('trashed'))
                    <input type="hidden" name="trashed" value="true">
                @endif
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Search categories..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>

            @if($isAdmin)
                <a href="{{ $showTrashed ? route('categories.index') : route('categories.index', ['trashed' => true]) }}" 
                   class="btn btn-outline-secondary mb-3 shadow-sm">
                    <i class="fas fa-trash-alt me-1"></i> {{ $showTrashed ? 'Show Active' : 'Show Trashed' }}
                </a>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            @if($isAdmin)
                                <th width="200px">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td class="fw-semibold text-info">{{ $category->name }}</td>
                                <td><img src="{{ asset('storage/'.$category->image) }}" class="rounded shadow" style="height: 50px; width: 50px;"></td>
                                <td>{!! \Illuminate\Support\Str::words($category->description, 5) !!}</td>
                                <td>
                                    @if($category->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                @if($isAdmin)
                                    <td>
                                        @if ($showTrashed)
                                            {{-- Restore --}}
                                            <form action="{{ route('categories.restore', $category) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-success" onclick="return confirm('Restore this category?')">
                                                    <i class="fas fa-undo"></i> Restore
                                                </button>
                                            </form>

                                            {{-- Erase --}}
                                            <form action="{{ route('categories.forceDelete', $category) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete this category?')">
                                                    <i class="fas fa-trash"></i> Erase
                                                </button>
                                            </form>
                                        @else
                                            {{-- Edit --}}
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 6 : 5 }}" class="text-center text-muted">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $categories->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
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
