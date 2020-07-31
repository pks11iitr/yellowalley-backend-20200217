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
    <section class="py-3 bg-light">
        @if(Session::get('refid'))
        <div class="container">
            <div class="row p-5">
                <div class="col-md-8 offset-md-2 text-center p-3" style="border: 2px solid #e2e2e2; border-radius: 4px;">
                    <h3 class="py-5">Your payment at Yellow Alley is successfull<br>

            Order ID is: {{Session::get('refid')}}</h3>

            <a href="{{route('website.chapters')}}" class="btn btn-blms">Continue</a>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->isSubscriptionActive())
            <div class="container">
                <div class="row p-5">
                    <div class="col-md-8 offset-md-2 text-center p-3" style="border: 2px solid #e2e2e2; border-radius: 4px;">
                        <h3 class="py-5">You Are Already A Paid Member.</h3>

                        <a href="{{route('website.chapters')}}" class="btn btn-blms">Continue</a>
                    </div>
                </div>
            </div>
        @else
        <div class="container">
            <div class="row p-5">
                <div class="col-md-8 offset-md-2 text-center p-3" style="border: 2px solid #e2e2e2; border-radius: 4px;">
                    <h3 class="py-5">Pay now to access the full course <br> Total: Rs.{{$payment_amount}} </h3>

                <a href="{{route('website.pay')}}" class="btn btn-blms">Continue</a>
                </div>
            </div>
        </div>
    <!--    <div class="container">
            <div class="row">
                <div class="col-md-12">
            Pay now to access the full course | Total: {{$payment_amount}}
                </div>
            </div>
            <div class="row">
                <a href="{{route('website.pay')}}" class="btn btn-warning">Continue</a>
            </div>
        </div>--->
        @endif
    </section>
@endsection
