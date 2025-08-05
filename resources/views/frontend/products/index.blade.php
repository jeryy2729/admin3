@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
            
            {{-- Optional Breadcrumb --}}
            <x-breadcrumbs :items="['Products' => '']" />

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-4 bg-light">
                <h2 class="mb-4 fw-bold text-center border-bottom pb-2">
                    Products Related to: 
                    <span class="text-primary">{{ $post->name }}</span>
                </h2>

                @if($products->isEmpty())
                    <div class="text-center py-5">
                        <img src="{{ asset('images/empty-cart.png') }}" alt="No Products" class="img-fluid mb-4" style="max-width: 300px;">
                        <p class="lead text-muted">No products found for this post.</p>
                        <a href="{{ route('frontend.posts.show', $post) }}" class="btn btn-outline-secondary mt-3">Back to Post</a>
                    </div>
                @else
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm border-0 product-card">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No Image">
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-dark fw-bold">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small mb-2">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>

                                        <div class="mb-2">
                                            <span class="fw-semibold text-success">PKR {{ number_format($product->price) }}</span><br>
                                            <small class="text-muted">
                                                Stock:
                                                <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ $product->stock > 0 ? $product->stock : 'Out of stock' }}
                                                </span>
                                            </small>
                                        </div>

                                        <div class="mt-auto">
                                            @if ($product->stock > 0)
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-grid">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-outline-danger w-100" disabled>
                                                    <i class="bi bi-x-circle me-1"></i> Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('frontend.posts.show', $post) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.product-card {
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    height: 220px;
    object-fit: cover;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
</style>
@endsection
