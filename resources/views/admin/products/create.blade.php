@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Create New Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label>Price (PKR)</label>
            <input type="number" name="price" class="form-control" required min="1" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
  <!-- Image -->
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-card-image text-primary me-1"></i>Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

         <div class="mb-3">
                    <label class="form-label"><i class="bi bi-tags-fill text-primary me-1"></i>Posts</label>
<select name="post_ids[]" class="form-select select2" multiple required>
                    @foreach($posts as $post)
    <option value="{{ $post->id }}" {{ collect(old('post_ids'))->contains($post->id) ? 'selected' : '' }}>
        {{ $post->name }}
    </option>
@endforeach

                    </select>
                    @error('posts')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
    <label>Stock Quantity</label>
    <input type="number" name="stock" class="form-control" required min="0" value="{{ old('stock', $product->stock ?? 0) }}">
</div>


        <button class="btn btn-success">Create Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
