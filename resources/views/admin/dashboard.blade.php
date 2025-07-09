@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Welcome Card -->
    <div class="card mb-4 border-0 shadow rounded-4">
        <div class="card-header bg-primary text-white fw-bold fs-5">
            👋 Welcome to the Admin Panel
        </div>
        <div class="card-body">
            <p class="mb-0 text-muted">Manage your content, users, posts, and categories from this central dashboard.</p>
        </div>
    </div>

    <!-- Stat Cards Section -->
    <div class="row g-4">

        <!-- Categories -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card h-100 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #6f42c1, #a471f9);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-folder-open fa-2x mb-2"></i>
                    <h6 class="fw-bold">Categories</h6>
                    <h4 class="fw-bolder">{{ $totalcategories }}</h4>
                </div>
            </div>
        </div>

        <!-- Posts -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card h-100 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f96d41, #f9a041);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-file-alt fa-2x mb-2"></i>
                    <h6 class="fw-bold">Posts</h6>
                    <h4 class="fw-bolder">{{ $totalposts }}</h4>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card h-100 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #28a745, #6fdc8c);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-users fa-2x mb-2"></i>
                    <h6 class="fw-bold">Users</h6>
                    <h4 class="fw-bolder">{{ $totaluser }}</h4>
                </div>
            </div>
        </div>

        <!-- Comments -->
        <div class="col-md-3 col-sm-6">
            <div class="card info-card h-100 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #007bff, #45aaf2);">
                <div class="card-body text-center py-4">
                    <i class="fa fa-comments fa-2x mb-2"></i>
                    <h6 class="fw-bold">Comments</h6>
                    <h4 class="fw-bolder">{{ $totalcomments }}</h4>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Optional Hover Effect --}}
<style>
    .info-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
        border-radius: 1rem;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
</style>
@endsection
