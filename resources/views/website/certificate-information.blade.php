@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-6 py-2">
                    <h4 class="">Certificate</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12 py-5">

                    @if($result['status']=='success')
                        <div class="form-group text-center">
                        Click download button to download your certificate.<br>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{route('website.certificate.download', ['code'=>$user->referral_code])}}" class="btn btn-blms">Download</a>
                        </div>
                    @else
                        <div class="form-group text-center">
                        You have not completed all chapters test. Please complete all tests to download your certificate.<br>
                        </div>
                        <div class="form-group text-center">
                        <a href="{{route('website.chapters')}}" class="btn btn-blms">Continue</a>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
