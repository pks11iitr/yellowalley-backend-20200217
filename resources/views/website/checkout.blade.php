<form action="{{route('website.verifypayment')}}" method="POST" name="payment_form">
    @csrf
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{$api_key}}"
        data-amount="{{$order->total_paid}}"
        data-currency="INR"
        data-order_id="{{$order->order_id}}"
        data-buttontext="Pay with Razorpay"
        data-name="Acme Corp"
        data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
        data-image="https://example.com/your_logo.jpg"
        data-prefill.name="Gaurav Kumar"
        data-prefill.email="gaurav.kumar@example.com"
        data-prefill.contact="9999999999"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
</form>
<script>
    window.onload = function(){
        document.getElementsByClassName('razorpay-payment-button')[0].click()
    }
</script>
