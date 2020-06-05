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
            <div class="row p-4">
                <div class="col-md-8 offset-md-2 text-center p-3" style="border: 2px solid #e2e2e2; border-radius: 4px;">
                    @if($result['status']=='success')
                        <div class="form-group  px-5">
                        <h3 class="py-5">Click download button to download your certificate.</h3>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{route('website.certificate.download', ['code'=>$user->referral_code])}}" class="btn btn-blms btn-md">Download</a>
                        </div>
                    @else
                        <div class="form-group px-5">
                        <h3 class="py-5">You have not completed all chapters test. Please complete all tests to download your certificate.</h3>
                        </div>
                        <div class="form-group text-center">
                        <a href="{{route('website.chapters')}}" class="btn btn-blms btn-md">Continue</a>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
