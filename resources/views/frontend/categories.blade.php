@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<x-breadcrumbs :items="['Categories' => '']" />

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-4 bg-light">

                {{-- Search Form --}}
                <form method="GET" action="{{ route('frontend.categories') }}">
                    <div class="input-group mb-4 shadow-sm">
                        <input type="text" name="search" class="form-control rounded-start" placeholder="Search categories..." value="{{ $search ?? '' }}" style="height: 45px;">
                        <button type="submit" class="btn btn-primary rounded-end px-4" style="height: 45px;">{{ __('messages.search') }}</button>
                    </div>
                </form>

                <h2 class="mb-4 fw-bold border-bottom pb-2">Explore Categories</h2>

                {{-- Categories Grid --}}
                <div class="row">
                    @forelse($categories as $category)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="category-card position-relative rounded-4 overflow-hidden shadow-lg">
                                {{-- Background Image --}}
                                <div class="category-bg" style="background-image: url('{{ $category->image ? asset('storage/' . $category->image) : asset('frontend/images/default-category.jpg') }}');"></div>

                                {{-- Overlay --}}
                                <div class="category-overlay p-4 text-white d-flex flex-column justify-content-end h-100 w-100">
                                    <h5 class="fw-bold">{{ $category->name }}</h5>
                                    <p class="small">{!! \Illuminate\Support\Str::limit(strip_tags($category->description), 80) !!}</p>
                                   <a href="{{ route('frontend.posts.show', $category->slug) }}?from=Categories" class="btn btn-sm btn-light text-dark rounded-pill px-3 mt-2">
    View Posts <i class="fa fa-arrow-right ms-1"></i>
</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">No categories available.</div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $categories->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.category-card {
    height: 260px;
    position: relative;
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-card:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
}

.category-bg {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    filter: brightness(0.75);
    transition: filter 0.3s ease;
}

.category-card:hover .category-bg {
    filter: brightness(0.6);
}

.category-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 1.25rem;
    height: 100%;
    width: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.65), rgba(0,0,0,0.05));
    backdrop-filter: blur(2px);
    z-index: 1;
}
</style>
@endsection
