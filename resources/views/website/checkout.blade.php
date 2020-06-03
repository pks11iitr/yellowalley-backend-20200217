@extends('website.layout')

@section('contents')
    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Subscribe</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Pay now to access the full course | Total: {{$payment->amount}}
                </div>
            </div>
            <div class="row">
                <a href="{{route('website.pay')}}" class="btn btn-warning">Continue</a>
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
            data-image="http://yellowalley.org/img/logo.png"
            data-prefill.name=""
            data-prefill.email=""
            data-prefill.contact=""
            data-theme.color="#F37254"
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

