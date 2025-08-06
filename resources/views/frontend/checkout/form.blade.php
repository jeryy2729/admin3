@extends('frontend.layouts.main')

@section('main-container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <h2 class="mb-4 text-center text-primary fw-bold">Secure Checkout</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $amount }}">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="customerName" value="{{ $user->name ?? '' }}" required class="form-control shadow-sm" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="customerEmail" value="{{ $user->email ?? '' }}" required class="form-control shadow-sm" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="customerPhone" required class="form-control shadow-sm">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="address" rows="3" required class="form-control shadow-sm"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Card Details</label>
                            <div id="card-element" class="form-control p-2 shadow-sm"></div>
                        </div>

                        <button id="submit-button" class="btn btn-lg btn-primary w-100 shadow">
                            <i class="bi bi-lock-fill me-2"></i>Pay PKR{{ $amount_display }}
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Stripe Scripts --}}
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const submitBtn = document.getElementById('submit-button');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing...';

        const { clientSecret } = await fetch('{{ route("create.payment.intent") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                amount: "{{ $amount }}",
                customerName: form.customerName.value,
                customerEmail: form.customerEmail.value,
                customerPhone: form.customerPhone.value,
            })
        }).then(r => r.json());

        const { error } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: form.customerName.value,
                    email: form.customerEmail.value,
                    phone: form.customerPhone.value
                }
            }
        });

        if (error) {
            alert(error.message);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Pay ${{ $amount_display }}';
        } else {
            form.submit();
        }
    });
</script>
@endsection
