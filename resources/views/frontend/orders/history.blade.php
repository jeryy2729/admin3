@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<x-breadcrumbs :items="['History' => '']" />

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
                                            <th>Refund Request</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="fw-semibold">#{{ $order->id }}</td>
                                                <td class="fw-semibold">{{ $order->products }}</td>
                                                <td class="text-success fw-semibold">PKR{{ number_format($order->total_amount, 2) }}</td>
                                                <td>
                                                    @if($order->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($order->status == 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif($order->status == 'failed')
                                                        <span class="badge bg-danger">Failed</span>
                                                    @elseif($order->status == 'delivered')
                                                        <span class="badge bg-info text-dark">Delivered</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>

                                               <td>
    @if (!$order->refundRequest)
        <!-- Refund Form Button -->
        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#refundModal{{ $order->id }}">
            Request Refund
        </button>

        <!-- Refund Request Modal -->
        <div class="modal fade" id="refundModal{{ $order->id }}" tabindex="-1" aria-labelledby="refundModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">
                    <div class="modal-header bg-warning text-dark rounded-top-4">
                        <h5 class="modal-title fw-bold" id="refundModalLabel{{ $order->id }}">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Refund Request - Order #{{ $order->id }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('refund.request', $order->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="reason{{ $order->id }}" class="form-label fw-semibold">Reason for Refund</label>
                                <textarea name="reason" id="reason{{ $order->id }}" rows="4" class="form-control" placeholder="Please describe why you're requesting a refund..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($order->refundRequest)
        <span class="text-info d-block">
            <i class="bi bi-check-circle me-1"></i>Refund Requested<br>
            <span class="small"><strong>Status:</strong> {{ ucfirst($order->refundRequest->status) }}</span>
        </span>
    @else
        <span class="text-muted">Not eligible</span>
    @endif
</td>

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
@push('scripts')
<!-- Bootstrap JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush