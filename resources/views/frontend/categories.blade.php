@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-4">
                {{-- Search Form --}}
                  <form method="GET" action="{{ route('frontend.categories') }}">
       <div class="input-group mb-4">
    <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ $search ?? '' }}" style="height: 45px;">
    <button type="submit" class="btn btn-primary" style="height: 45px; padding: 0 16px;">Search</button>
</div>

    </form>

                <h2 class="mb-4">Categories</h2>

                <div class="row">
                    @forelse($categories as $category)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text">{{ $category->description }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No categories available.</p>
                        </div>
                    @endforelse
                </div>

                {{-- ✅ Compact Pagination --}}
                <div class="mt-4">
                    {{ $categories->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
