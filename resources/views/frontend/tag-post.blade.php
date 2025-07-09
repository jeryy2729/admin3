@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">

            {{-- ✅ Left Sidebar --}}
            <div class="col-md-3 border-end bg-light px-4 py-4">
                <div class="sticky-top" style="top: 80px">
                    <h5 class="mb-3 border-bottom pb-2 fw-bold text-primary">📁 Categories</h5>
                    <ul class="list-unstyled mb-4">
                        @foreach($categories as $cat)
                            <li class="mb-2">
                                <a href="#" class="d-block px-3 py-2 rounded text-dark hover-effect fw-semibold">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h5 class="mb-3 border-bottom pb-2 fw-bold text-primary">🏷️ Tags</h5>
                    <ul class="list-unstyled">
                        @foreach($tags as $tagItem)
                            <li class="mb-2">
                                <a href="#" class="d-block px-3 py-2 rounded text-dark hover-effect fw-semibold">
                                    {{ $tagItem->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ✅ Right Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-white">
                <div class="mb-5 text-center">
                    <h2 class="fw-bold text-primary">Posts Tagged: {{ $tag->name }}</h2>
                    <p class="text-muted">Explore all articles associated with this tag</p>
                </div>

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

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $posts->onEachSide(1)->links('pagination::bootstrap-4') }}
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
