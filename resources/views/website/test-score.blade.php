@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 d-flex justify-content-center">
                    <h3 class="text-center py-5">Results: {{$test->chapter->title}}</h3>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="icon text-center pro_img"><img src="{{asset('img/resut_icons.jpg')}}"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12 py-5">
                        <div class="form-group text-center">
                            <h5>Your Score</h5>
                            <h4>{{$result['score']}}/{{$result['totalscore']}}</h4>
                            <h6>Result Status: {{$result['pass_status']=='no'?'Failed':'Pass'}}</h6>
                            <h7>@if($result['pass_status']=='yes')
                                    @if($result['next_chapter_id']=='completed')
                                        Congratulations! <br>You Have Completed All Chapters. You Can Download Your Certificate.
                                    @else
                                        Congratulations! <br>Click Continue To Unlock Next Chapter
                                    @endif
                                @else
                                    Sorry You Failed The Test! <br>Click Continue To Study The Chapter Again.
                                @endif
                            </h7>
                        </div>

                            <div class="form-group text-center">
                            @if($result['next_chapter_id']=='completed')
                                    <a href="{{route('website.chapters')}}" class="btn btn-blms">Continue</a>
                            @else
                                    <a href="{{route('website.chapter.details', ['id'=>$result['next_chapter_id']])}}" class="btn btn-blms">Continue</a>
                            @endif

                        </div>

                </div>
            </div>
        </div>
    </section>



@endsection
