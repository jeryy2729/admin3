@extends('admin.layouts.app')

@section('content')
@include('components.alerts')

<div class="container-fluid py-4">
    @if(Auth::guard('admin')->check())
        <div class="mb-3">
            <h5 class="fw-bold text-muted">Welcome, {{ Auth::guard('admin')->user()->name }}</h5>
        </div>
    @endif

    <!-- Welcome Card -->
    <div class="card mb-4 border-0 shadow rounded-4">
        <div class="card-header bg-primary text-white fw-bold fs-5">
            👋 Welcome to the Admin Panel
        </div>
        <div class="card-body">
            <p class="mb-0 text-muted">Manage your content, users, posts, and categories from this central dashboard.</p>
        </div>
    </div>

   <!-- Import / Export Actions -->
<div class="d-flex flex-wrap align-items-center gap-3 mb-4">
    <!-- Import Form -->
    <form method="POST" action="{{ route('categories.import') }}" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
        @csrf
        <input type="file" name="excel_file" class="form-control form-control-sm" required>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-upload me-1"></i> Import Categories
        </button>
    </form>

    <!-- Export Form -->
    <form method="POST" action="{{ route('categories.export') }}" class="d-flex align-items-center gap-2">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">
            <i class="fa fa-download me-1"></i> Export Categories
        </button>
    </form>
</div>

    <!-- Stat Cards -->
    <div class="row g-4">

        <!-- Pending Approvals -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #dc3545, #ff6b6b);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-hourglass-half fa-2x mb-2"></i>
                    <h6 class="fw-bold">Pending Approvals</h6>
                    <h4 class="fw-bolder">{{ $pendingApprovals }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #6f42c1, #a471f9);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-folder-open fa-2x mb-2"></i>
                    <h6 class="fw-bold">Categories</h6>
                    <h4 class="fw-bolder">{{ $totalcategories }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Posts -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-file-alt fa-2x mb-2"></i>
                    <h6 class="fw-bold">Posts</h6>
                    <h4 class="fw-bolder">{{ $totalposts }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #28a745, #6fdc8c);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-users fa-2x mb-2"></i>
                    <h6 class="fw-bold">Users</h6>
                    <h4 class="fw-bolder">{{ $totaluser }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #007bff, #45aaf2);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-comments fa-2x mb-2"></i>
                    <h6 class="fw-bold">Comments</h6>
                    <h4 class="fw-bolder">{{ $totalcomments }}</h4>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Optional Hover Effect -->
@endsection
@push('styles')
<style>
    .info-card {
        transition: all 0.3s ease;
        border-radius: 1rem;
        cursor: pointer;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.3), 0 10px 20px rgba(0, 0, 0, 0.2);

    }

    .info-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        opacity: 0.95;
    }

    .info-card i {
        transition: transform 0.3s ease;
    }

    .info-card:hover i {
        transform: rotate(10deg) scale(1.1);
    }
</style>
@endpush