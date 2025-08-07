@extends('admin.layouts.app')

@section('content')
<div class="main-content py-4" id="main-content">
    <div class="container">
        <!-- Toggle button for sidebar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Edit Order Status</h2>
            <button class="btn btn-outline-secondary d-md-none" id="toggle-btn" onclick="toggleSidePanel()">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Alert Message -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Edit Order Form -->
        <div class="card shadow rounded">
            <div class="card-body">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><strong>User Email:</strong></label>
                            <input type="email" class="form-control" value="{{ $order->email }}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>Old Status:</strong></label>
                            <input type="text" class="form-control" value="{{ $order->status }}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label"><strong>Edit Status:</strong></label>
                            <select name="status" class="form-select" required>
                                <option value="" disabled {{ old('status', $order->status) == '' ? 'selected' : '' }}>Select Status</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Update Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">← Back to Orders</a>
        </div>
    </div>
</div>
@endsection
