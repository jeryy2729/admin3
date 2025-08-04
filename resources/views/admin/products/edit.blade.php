@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label>Price (PKR)</label>
            <input type="number" name="price" class="form-control" required min="1" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>
                        <div class="mb-3">
            <label class="form-label"><i class="bi bi-tags-fill text-primary me-1"></i>Posts</label>
            <select name="post_ids[]" class="form-select select2" multiple required>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}" 
                        {{ (in_array($post->id, old('post_ids', $product->posts->pluck('id')->toArray()))) ? 'selected' : '' }}>
                        {{ $post->name }}
                    </option>
                @endforeach
            </select>
            @error('post_ids')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>



                <!-- Current Image -->
                <div class="form-group mb-4">
                    <label class="form-label fw-semibold"><i class="bi bi-image text-primary me-1"></i>Current Image:</label><br>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Post Image" class="img-thumbnail mb-2" width="140">
                    @else
                        <p>No image uploaded.</p>
                    @endif
                </div>

                <!-- New Image -->
                <div class="form-group mb-4">
                    <label class="form-label"><i class="bi bi-upload me-1 text-primary"></i>Change Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
<div class="mb-3">
    <label>Stock Quantity</label>
    <input type="number" name="stock" class="form-control" required min="0" value="{{ old('stock', $product->stock ?? 0) }}">
</div>

        <button class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
