@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
{{--                <div class="col-6 py-2">--}}
{{--                    <h4 class="">Take test</h4>--}}
{{--                </div>--}}
            </div>
            <div class="row">
                <div class="col-md-12 mb-5 d-flex justify-content-center">
                    <h3 class="text-center py-5">{{$chapter->title}}</h3>
                </div>
                <!-- <div class="col-md-12 d-flex justify-content-center">
                    <div class="icon text-center"><img src="{{asset('img/brain-icon.png')}}"></div>
                </div> -->
                <div class="col-md-12 d-flex justify-content-center ">
                    <div class="icon text-center pro_img"><img src="{{asset('img/test_icon.jpg')}}"></div>
                </div>

            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-12 py-5">
                    <form action="{{route('website.view.question', ['testid'=>$test->refid, 'questionid'=>$question->sequence_no])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="h3 mb-3">{{$question->sequence_no}} - {{$question->question}}</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios1" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    A.&nbsp;&nbsp; {{$question->option1}}
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios2" value="2">
                                <label class="form-check-label" for="exampleRadios2">
                                    B.&nbsp;&nbsp; {{$question->option2}}
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios3" value="3">
                                <label class="form-check-label" for="exampleRadios3">
                                    C.&nbsp;&nbsp; {{$question->option3}}
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios2" value="4">
                                <label class="form-check-label" for="exampleRadios2">
                                    D.&nbsp;&nbsp; {{$question->option4}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-blms">Answer</button>
                        </div>


                    </form>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{$question->sequence_no>1?route('website.view.question',['testid'=>$test->refid, 'questionid'=>$question->sequence_no-1]):'javascript:void(0)'}}">Previous</a></li>
                            @foreach($questions as $q)
                            <li class="page-item {{$q->id==$question->id?'active':''}}"><a class="page-link" href="{{route('website.view.question',['testid'=>$test->refid, 'questionid'=>$q->sequence_no])}}">{{$q->sequence_no}}</a></li>
                            @endforeach
                            <li class="page-item"><a class="page-link" href="{{$question->sequence_no<count($questions)?route('website.view.question',['testid'=>$test->refid, 'questionid'=>$question->sequence_no+1]):'javascript:void(0)'}}">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>



@endsection
