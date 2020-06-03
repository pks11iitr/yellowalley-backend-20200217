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
        @if(Session::get('refid'))

            Your payment at Yellow Alley is successfull<br>

            Order ID is: {{Session::get('refid')}}

            <a href="{{route('website.chapters')}}" class="btn btn-warning">Continue</a>

        @else

        <div class="container">
            <div class="row">
                <div class="col-md-12">
            Pay now to access the full course | Total: {{$payment_amount}}
                </div>
            </div>
            <div class="row">
                <a href="{{route('website.pay')}}" class="btn btn-warning">Continue</a>
            </div>
        </div>
        @endif
    </section>
@endsection
