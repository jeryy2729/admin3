@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">All Products</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price (PKR)</th>
                <th>Posts</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
               <td><img src="{{ asset('storage/'.$product->image) }}" class="rounded shadow" style="height: 50px; width: 50px;"></td>

                <td>{{ number_format($product->price) }}</td>
                <td>
                    @foreach ($product->posts as $post)
                        <span class="badge bg-secondary">{{ $post->name }}</span>
                    @endforeach
                </td>
                <td>{{ $product->stock }}</td>

                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this product?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No products found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
