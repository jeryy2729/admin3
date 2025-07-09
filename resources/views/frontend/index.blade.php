@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">

            {{-- Main Content --}}
            <div class="col-md-12">
                <div class="container py-4">

                    <!-- Slider Section -->
                    <!-- <section class="slider mb-5 bg-primary text-white p-5 rounded">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="block">
                                    <span class="d-block mb-3 text-white text-uppercase">Shape Your Future with Us</span>
                                    <h1 class="animated fadeInUp mb-4 display-4 fw-bold">We Turn Ideas<br>Into Reality</h1>
                                    <a href="#" class="btn btn-light btn-lg animated fadeInUp">
                                        Get Started <i class="fa fa-angle-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section> -->

                    <!-- Intro Section -->
                    
                    <!-- Counter Section -->
                    <!-- <section class="bg-light py-5 mb-5 rounded">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h2 class="text-primary fw-bold">100+</h2>
                                <p>Projects Completed</p>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-success fw-bold">50+</h2>
                                <p>Satisfied Clients</p>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-warning fw-bold">25+</h2>
                                <p>Awards Won</p>
                            </div>
                            <div class="col-md-3">
                                <h2 class="text-danger fw-bold">24/7</h2>
                                <p>Support</p>
                            </div>
                        </div>
                    </section> -->

                    <!-- Testimonials Section -->
            <!-- Testimonials Section with Posts & Comments -->
<section class="testimonials mb-5">
    <div class="text-center mb-5">
        <span class="h6 text-color">What’s New</span>
        
    </div>

    <div class="row">
        <!-- 📝 Left: Featured Posts -->
        <div class="col-md-8">
              <div class="row">
    @forelse($posts as $post)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                @if($post->image)
                    <div class="post-bg-img" style="background-image: url('{{ asset('storage/' . $post->image) }}'); height: 120px;"></div>
                @endif

                <div class="card-body p-3">
                    <h6 class="mb-1 fw-semibold" style="font-size: 0.95rem;">
                        <a href="{{ route('frontend.post-detail', $post->id) }}" class="text-decoration-none text-primary">
                            {{ Str::limit($post->name, 40) }}
                        </a>
                    </h6>

                    <p class="text-muted small mb-1" style="font-size: 0.85rem;">
                        {{ Str::limit(strip_tags($post->description), 60) }}
                    </p>

                    @if($post->tags->count())
                        <div class="mb-1">
                            @foreach($post->tags as $t)
                                <span class="badge bg-info text-dark rounded-pill small me-1">{{ $t->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-muted">📂 {{ $post->category->name ?? '-' }}</small>
                        <span class="badge {{ $post->status ? 'bg-success' : 'bg-secondary' }} small">
                            {{ $post->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">No posts found for this tag.</p>
    @endforelse
</div>

        </div>

        <!-- 💬 Right: Recent Comments -->
        <div class="col-md-4">
            <div class="bg-white border rounded-4 shadow-sm p-4 h-100">
                <h5 class="fw-bold text-primary mb-3">💬 Recent Comments</h5>
                @forelse($recentComments as $comment)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <strong class="text-dark">{{ $comment->user->name }}</strong>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="text-secondary small mb-1">On: 
                            <a href="{{ route('frontend.posts.show', $comment->post->slug) }}" class="text-decoration-none text-primary">
                                {{ $comment->post->name }}
                            </a>
                        </p>
                        <p class="text-muted small">{{ Str::limit($comment->comment, 60) }}</p>
                    </div>
                @empty
                    <p class="text-muted">No recent comments found.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    .hover-effect:hover {
        background-color: #f8f9fa;
        text-decoration: none;
        color: #f96d41;
    }
    .post-bg-img {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
@endsection
