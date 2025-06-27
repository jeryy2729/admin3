@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">

            {{-- Sidebar (Left Side) --}}
            <div class="col-md-3 border-end px-4 py-4 bg-light">
                <div class="sticky-top" style="top: 80px">
                    <h5 class="mb-3 border-bottom pb-2 fw-bold text-dark">📁 Categories</h5>
                    <ul class="list-unstyled mb-4">
                        @foreach($categories as $cat)
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-dark d-block px-2 py-1 rounded hover-effect fw-bold">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h5 class="mb-3 border-bottom pb-2 fw-bold text-dark">🏷️ Tags</h5>
                    <ul class="list-unstyled">
                        @foreach($tags as $tag)
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-dark d-block px-2 py-1 rounded hover-effect fw-bold">
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Main Content (Right Side) --}}
            <div class="col-md-9 px-4 py-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4 text-primary">{{ $post->name }}</h2>

                        <h5 class="fw-bold mb-2 text-dark">📂 Category</h5>
                        <p class="mb-4"><span class="fw-semibold">{{ $post->category->name }}</span></p>

                        <h5 class="fw-bold mb-2 text-dark">📄 Description</h5>
                        <p class="text-secondary mb-4">{{ $post->description }}</p>

                        @if($post->tags->count())
                            <h5 class="fw-bold mb-2 text-dark">🏷️ Tags</h5>
                            <div class="mb-4">
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-info text-dark me-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <h5 class="fw-bold mb-2 text-dark">📌 Status</h5>
                        <span class="badge {{ $post->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $post->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Hover Styling --}}
<style>
    .hover-effect:hover {
        background-color: #f1f1f1;
        text-decoration: none;
        font-weight: 500;
    }
</style>
@endsection
