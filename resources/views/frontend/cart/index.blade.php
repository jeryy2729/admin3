@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-0">
<!-- <x-breadcrumbs :items="['Cart' => '']" /> -->
<x-breadcrumbs :items="[__('messages.cart') => '']" />

            {{-- Sidebar --}}
            @include('frontend.layouts.sidebar')

            {{-- Main Content --}}
            <div class="col-md-9 px-4 py-5 bg-light">
                <h2 class="text-center fw-bold mb-5">🛒 Your Shopping Cart</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(count($cartItems) > 0)
                    <div class="row">
                        <!-- Cart Items -->
                        <div class="col-lg-8 mb-4">
                            <div class="card shadow border-0">
                                <div class="card-header bg-white border-bottom">
                                    <h5 class="mb-0">Cart Items</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product" class="img-thumbnail rounded shadow-sm me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                <small class="text-muted">PKR {{ number_format($item->product->price) }}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-light text-dark px-3 py-2">Qty: {{ $item->quantity }}</span>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ms-3">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this item?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('cart.increase', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-success" onclick="return confirm('Increase quantity?')">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('cart.decrease', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-dash-circle"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="col-lg-4">
                            <div class="card shadow border-0">
                                <div class="card-header bg-white border-bottom">
                                    <h5 class="mb-0">Summary</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
                                    @endphp

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span><strong>PKR {{ number_format($subtotal) }}</strong></span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-4">
                                        <span>Delivery:</span>
                                        <span>PKR 0</span>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between fs-5 mb-4">
                                        <span><strong>Total:</strong></span>
                                        <span><strong>PKR {{ number_format($subtotal) }}</strong></span>
                                    </div>

                                    <a href="{{ route('checkout.show') }}" class="btn btn-outline-primary w-100">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty Cart Message -->
                    <div class="text-center">
                        <img src="{{ asset('images/empty-cart.png') }}" alt="Empty Cart" style="max-width: 300px;" class="img-fluid mb-4">
                        <h4>Your cart is empty!</h4>
                        <a href="{{ route('frontend.index') }}" class="btn btn-outline-primary mt-3">Continue Shopping</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
