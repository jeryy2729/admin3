@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Refund Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($refunds->isEmpty())
        <div class="alert alert-info">No refund requests found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Order ID</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($refunds as $refund)
                        <tr>
                            <td>{{ $refund->id }}</td>
                            <td>{{ $refund->user->name ?? 'N/A' }}<br><small>{{ $refund->user->email ?? '' }}</small></td>
                            <td>#{{ $refund->order->id ?? 'N/A' }}</td>
                            <td>{{ $refund->reason }}</td>
                            <td>
                                @if($refund->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($refund->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $refund->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                @if($refund->status === 'pending')
                                    <form action="{{ route('admin.refunds.approve', $refund->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>

                                    <form action="{{ route('admin.refunds.reject', $refund->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @else
                                    <em>No Action</em>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
