@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            <div class="col-md-9 px-4 py-4">
                <h1 class="mb-5 text-center fw-bold">Posts Grouped by Categories</h1>

                {{-- Loop through paginated categories --}}
                @forelse($categories as $category)
                    <div class="mb-5">
                        <h3 class="border-start border-4 border-primary ps-3 text-dark">{{ $category->name }}</h3>
                        <hr>

                        {{-- Show related posts of this category --}}
                        @forelse($category->posts as $post)
                            <div class="mb-3 p-3 border rounded shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">
                                        <a href="{{ route('frontend.post-detail', $post->id) }}" class="text-decoration-none text-primary">
                                            {{ $post->name }}
                                        </a>
                                    </h5>
                                    <span class="badge {{ $post->status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $post->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <p class="mb-0">{{ Str::limit($post->description, 150) }}</p>
                            </div>
                        @empty
                            <p class="text-muted">No posts found in this category.</p>
                        @endforelse
                    </div>
                @empty
                    <p>No categories available.</p>
                @endforelse

                {{-- ✅ PAGINATION (for categories) --}}
                <div class="mt-4">
                    {{ $categories->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
