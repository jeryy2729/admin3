@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5">
    <h2 class="mb-4 text-primary">🛍️ Products Related to "{{ $post->name }}"</h2>

    @if($products->count())
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">PKR {{ number_format($product->price) }}</p>
                            <p class="card-text small">{{ Str::limit($product->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No products linked to this post yet.</p>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">← Back</a>
</div>
@endsection
