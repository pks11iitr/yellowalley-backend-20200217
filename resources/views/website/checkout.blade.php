@extends('website.layout')

@section('contents')
    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Pay Now</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row p-5">
                <div class="col-md-8 offset-md-2 text-center p-3" style="border: 2px solid #e2e2e2; border-radius: 4px;">
                    <h3 class="py-5">Pay now to access the full course <br> Total:Rs. {{$payment->amount}} </h3>

                <a href="{{route('website.pay')}}" class="btn btn-blms">Continue</a>
                </div>
            </div>
        </div>
    </section>
    <form action="{{route('website.payment.verify')}}" method="POST" name="payment_form" style="display:none">
        @csrf
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{$api_key}}"
            data-amount="{{$payment->amount}}"
            data-currency="INR"
            data-order_id="{{$payment->razorpay_order_id}}"
            data-buttontext="Pay with Razorpay"
            data-name="Yellow Alley"
            data-description=""
            data-prefill.name=""
            data-prefill.email=""
            data-prefill.contact=""
        ></script>
        <input type="hidden" custom="Hidden Element" name="hidden">
    </form>
    <div style="display:none">
        <script>
            window.onload = function(){
                document.getElementsByClassName('razorpay-payment-button')[0].click()
            }
        </script>
    </div>
@endsection

