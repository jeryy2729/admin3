<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe PaymentIntent - Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h2>Stripe Payment (Test Mode)</h2>

    <div style="max-width: 400px;">
        <label>Enter Amount (PKR):</label>
        <input type="number" id="amount" placeholder="1000" min="10"><br><br>

        <label>Card Details:</label>
        <div id="card-element"></div><br>

        <button id="pay-button">Pay</button>

        <div id="payment-result" style="margin-top:20px; color: green;"></div>
    </div>

    <script>
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.getElementById('pay-button').addEventListener('click', async () => {
            const amount = document.getElementById('amount').value;
            const resultDiv = document.getElementById('payment-result');
            resultDiv.innerText = '';

            if (!amount || amount < 10) {
                resultDiv.style.color = "red";
                resultDiv.innerText = "Enter valid amount in PKR (min Rs. 10)";
                return;
            }

            const response = await fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    amount: Math.round(amount * 100) // Convert to paisa
                })
            });

            const data = await response.json();

            if (data.error) {
                resultDiv.style.color = "red";
                resultDiv.innerText = data.error;
                return;
            }

            const clientSecret = data.clientSecret;

            const result = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                }
            });

            if (result.error) {
                resultDiv.style.color = "red";
                resultDiv.innerText = result.error.message;
            } else if (result.paymentIntent.status === 'succeeded') {
                resultDiv.style.color = "green";
                resultDiv.innerText = "✅ Payment Successful!";
            }
        });
    </script>
</body>
</html>
