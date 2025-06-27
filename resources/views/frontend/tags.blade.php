@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-4">
                <h1 class="mb-5 text-center fw-bold">Explore Tags</h1>

                @if($tags->count())
                    <div class="row">
                        @foreach($tags as $tag)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <a href="{{ route('frontend.tag-post', $tag->id) }}" class="text-decoration-none">
                                    <div class="p-4 border rounded shadow-sm bg-light h-100 text-center hover-shadow">
                                        <h5 class="text-primary mb-0">{{ $tag->name }}</h5>
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
                    <p>No tags found.</p>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
