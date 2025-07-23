@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">

            <!-- 🌟 Main Content -->
            <div class="col-md-12">
                <div class="container py-4">

                    <!-- 🌈 Hero Section -->
                    <section class="py-5 bg-gradient-primary border-bottom text-center text-white rounded-4 shadow-sm" style="background: linear-gradient(to right, #f96d41, #ffa751);">
                        <div class="container">
                            <h2 class="fw-bold mb-3 display-5">
                                ✨ Welcome to <span style="text-shadow: 1px 1px 5px #fff;">MegaKit</span>
                            </h2>
                            <p class="lead mx-auto" style="max-width: 800px;">
                                <i class="fas fa-lightbulb me-2"></i>Explore powerful ideas, expert tips, and inspiring stories. Stay curious, stay inspired — every day with <strong>MegaKit</strong>!
                            </p>
                            <a href="#" class="btn btn-light mt-3 px-4 py-2 shadow rounded-pill">
                                <i class="fas fa-arrow-down me-1"></i> Start Exploring
                            </a>
                        </div>
                    </section>

                    <!-- 📝 Posts Section -->
                    <section id="posts" class="mb-5 mt-4">
                        <div class="text-center mb-4">
                            <span class="h5 text-color text-uppercase">🔥 What’s New</span>
                            <h3 class="fw-bold mt-2" style="color: #f96d41;">Latest Posts</h3>
                        </div>

                        <div class="row">
                            @forelse($posts as $post)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card post-card h-100 shadow border-0 rounded-4 overflow-hidden position-relative">
                                        @if($post->image)
                                            <div class="post-image" style="background-image: url('{{ asset('storage/' . $post->image) }}'); height: 180px;"></div>
                                        @endif

                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="badge bg-gradient-orange text-white px-3 py-1 shadow-sm">New</span>
                                                @if($post->category)
                                                    <small class="text-muted">
                                                        <i class="fas fa-folder-open me-1"></i>{{ $post->category->name }}
                                                    </small>
                                                @endif
                                            </div>

                                            <h6 class="fw-bold" style="font-size: 1rem;">
                                                <a href="{{ route('frontend.post-detail', $post) }}?from=Home" class="text-decoration-none text-dark hover-orange">
                                                    {{ Str::limit($post->name, 60) }}
                                                </a>
                                            </h6>

                                            <p class="text-muted small mt-2 mb-0">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ $post->created_at->format('M d, Y') }}
                                            </p>
                                        </div>

                                        <!-- 👁 View Count -->
                                        <div class="position-absolute bottom-0 end-0 m-3">
                                            <span class="badge bg-info text-dark px-3 py-2 shadow-sm">
                                                <i class="fas fa-eye me-1"></i> {{ $post->views }} Views
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center">No posts found.</p>
                            @endforelse
                        </div>
                    </section>

                </div> <!-- container -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</div> <!-- main-wrapper -->

<!-- 💅 Styles -->
<style>
    .post-image {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transition: transform 0.3s ease-in-out;
    }

    .post-card:hover .post-image {
        transform: scale(1.05);
    }

    .post-card:hover {
        box-shadow: 0 0 20px rgba(249, 109, 65, 0.2);
        transform: translateY(-4px);
        transition: all 0.3s ease;
    }

    .hover-orange:hover {
        color: #f96d41 !important;
    }

    .bg-gradient-orange {
        background: linear-gradient(to right, #f96d41, #ffcd70);
        color: #fff;
    }

    .text-color {
        color: #f96d41;
    }
</style>
@endsection
