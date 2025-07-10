@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<x-breadcrumbs :items="['Tags' => '']" />

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-white">
                <h2 class="mb-5 text-center fw-bold text-primary">🎯 Explore Popular Tags</h2>

                @if($tags->count())
                    <div class="row">
                        @foreach($tags as $tag)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <a href="{{ route('frontend.tag-post', $tag) }}" class="text-decoration-none">
                                    <div class="tag-card text-center p-4 rounded-4 shadow-sm h-100 text-white">
                                        <div class="mb-2">
                                            <i class="fas fa-tag fa-2x"></i>
                                        </div>
                                        <h5 class="fw-semibold">{{ $tag->name }}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $tags->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <p class="text-muted">No tags found.</p>
                @endif
            </div>

        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
    .tag-card {
        background: linear-gradient(135deg, #f96d41, #f9a041);
        transition: all 0.3s ease-in-out;
    }

    .tag-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        background: linear-gradient(135deg, #f9a041, #f96d41);
        text-decoration: none;
    }

    .tag-card i {
        color: #fff;
    }

    .tag-card h5 {
        margin-top: 10px;
    }
</style>
@endsection
