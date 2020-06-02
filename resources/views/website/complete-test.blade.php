@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-6 py-2">
                    <h4 class="">Test Submission</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-5 d-flex justify-content-center">
                    <h3 class="text-center py-5">{{$chapter->title}}</h3>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="icon text-center"><img src="{{asset('img/brain-icon.png')}}"></div>
                </div>

            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12 py-5">
                    <form action="{{route('website.show.score', ['testid'=>$test->refid])}}" method="get">
                        @csrf

                        <div class="form-group text-center">
                            <h4>Congratulations, you have successfully completed this test. Please submit test to get results</h4>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-blms">Submit Test</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection
