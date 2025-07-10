@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">


            {{-- Main Content --}}
            <div class="col-md-12">
                <div class="container py-4">
<section class="py-5 bg-white border-bottom">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="color: #f96d41;">Welcome to MegaKit</h2>
        <p class="lead mx-auto text-secondary" style="max-width: 800px; font-size: 1.15rem; line-height: 1.8;">
            <span class="d-inline-block mb-2" style="font-size: 1.25rem; color: #f96d41;"><i class="fas fa-lightbulb me-2"></i>Explore Ideas</span><br>
            MegaKit is your gateway to <strong>insightful articles</strong>, <strong>expert advice</strong>, and <strong>inspiring stories</strong> across a variety of topics. Whether you're a curious reader, an aspiring writer, or a passionate learner, our blog is built to <span class="text-primary">inform</span>, <span class="text-success">engage</span>, and <span class="text-warning">spark new ideas</span> — every single day.
        </p>
    </div>
</section>

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
                        <a href="{{ route('frontend.post-detail', $post) }}?from=Home" class="text-decoration-none text-primary">
                            {{ Str::limit($post->name, 40) }}
                        </a>
                    </h6>

                    <!-- <p class="text-muted small mb-1" style="font-size: 0.85rem;">
                        {{ Str::limit(strip_tags($post->description), 60) }}
                    </p> -->
<!-- 
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
                         -->

        <!-- 👁 View Count at Bottom Right -->
        <div class="position-absolute bottom-0 end-0 m-3">
            <span class="badge bg-info text-dark px-3 py-2 shadow-sm">
                <i class="fas fa-eye me-1"></i> {{ $post->views }} Views
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
        <!-- <div class="col-md-4">
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
        </div> -->
    </div>
</section>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    
    .post-bg-img {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
@endsection
