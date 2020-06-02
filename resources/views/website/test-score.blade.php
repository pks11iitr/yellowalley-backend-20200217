@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 d-flex justify-content-center">
                    <h3 class="text-center py-5">Results: {{$test->chapter->title}}</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12 py-5">
                        <div class="form-group text-center">
                            <h5>Test Score</h5>
                            <h4>{{$result['score']}}/{{$result['totalscore']}}</h4>
                            <h6>Qualify Status: {{$result['pass_status']}}</h6>
                        </div>

                            <div class="form-group text-center">
                            <a href="{{route('website.chapters')}}" class="btn btn-blms">Continue</a>
                        </div>

                </div>
            </div>
        </div>
    </section>



@endsection
