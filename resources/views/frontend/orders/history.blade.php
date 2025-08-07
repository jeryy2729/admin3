@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-light">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <h2 class="mb-4 text-center text-primary fw-bold">
                            <i class="bi bi-clock-history me-2"></i> Order History
                        </h2>

                        @if($orders->isEmpty())
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle-fill me-2"></i>No orders found.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#Order ID</th>
                                            <th>Products</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Ordered At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="fw-semibold">#{{ $order->id }}</td>
                                                <td class="fw-semibold">{{ $order->products }}</td>
                                                <td class="text-success fw-semibold">${{ number_format($order->total_amount, 2) }}</td>
                                                <td>
                                                    @if($order->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($order->status == 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif($order->status == 'failed')
                                                        <span class="badge bg-danger">Failed</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
