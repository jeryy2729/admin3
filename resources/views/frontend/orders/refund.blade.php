@if(!$order->refundRequest)
<form action="{{ route('refund.request', $order->id) }}" method="POST">
    @csrf
    <textarea name="reason" required placeholder="Why are you requesting a refund?"></textarea>
    <button type="submit">Request Refund</button>
</form>
@elseif($order->refundRequest)
    <p>Refund Status: {{ $order->refundRequest->status }}</p>
@endif
