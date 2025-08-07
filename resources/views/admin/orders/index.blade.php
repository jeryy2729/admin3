@extends('admin.layouts.app')

@section('content')
<div class="main-content py-4" id="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Order Management</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>
                                        @if (is_array($order->products))
                                            {{ implode(', ', $order->products) }}
                                        @else
                                            {{ $order->products }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($order->status === 'delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->status === 'pending')
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @elseif ($order->status === 'delivered')
                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                <i class="fas fa-lock"></i> No Action
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
