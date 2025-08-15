@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<x-breadcrumbs :items="[
     __('messages.category') => route('frontend.categories'),

    $category->name => ''
]" />

            {{-- ✅ Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- ✅ Main Content --}}
            <div class="col-md-9 px-4 py-4 bg-light">

                {{-- Category Description (less padding, smaller text) --}}
                <div class="category-info text-center px-4 py-3 mb-4 rounded-4 shadow-sm" style="background: linear-gradient(to right, #f96d41, #fcb045); color: white;">
                    <h3 class="mb-2">{{ $category->name }}</h3>
                    <p class="lead mb-0" style="font-size: 1rem;">{!! $category->description !!}</p>
                </div>

                {{-- Posts Grid --}}
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card post-card shadow-sm h-100 border-0 rounded-4 overflow-hidden" style="min-height: 340px;">

                                {{-- Post Image --}}
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top img-fluid" style="height: 160px; object-fit: cover;" alt="Post Image">
                                @endif

                                {{-- Post Content --}}
                                <div class="card-body d-flex flex-column p-3">
 <a href="{{ route('frontend.post-detail', $post)}}?from=category" class="text-decoration-none text-primary">
                                    {{ $post->name }}
                                </a>
                                    <p class="text-muted flex-grow-1" style="font-size: 0.9rem;">{{ Str::limit(strip_tags($post->description), 90) }}</p>
                                    <!-- <a href="{{ route('frontend.posts.show', $post->slug) }}" class="btn btn-outline-primary btn-sm align-self-start mt-2 rounded-pill px-3">
                                        Read More <i class="fa fa-arrow-right ms-1"></i>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">No posts available in this category.</div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
    .post-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.12);
    }

    .card-title {
        font-size: 1rem;
        color: #333;
    }

    .category-info h3 {
        font-size: 1.5rem;
    }

    .category-info p {
        font-size: 0.95rem;
    }
</style>
@endsection
