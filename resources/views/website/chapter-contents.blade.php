@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">{{$chapter->title}}</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="big-video-testimonial-block">
                        <div class="video-thumbnail"><img src="{{$chapter->image}}" alt="" class="img-fluid"></div>
                        @if($chapter->lock_status['status']=='locked')
                        <div class="video-icon"><i class="fa fa-lock"></i></div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-prfle py-2">
                        <div class="art-title">
                            <h3>{{$chapter->title}}</h3>
                            <p class="py-2"><span class="course-sub">{{$chapter->description}}</span></p>
{{--                            <p> <span class="daysago"><i class="fa fa-clock-o" aria-hidden="true"></i> 12.05</span></p>--}}
                        </div>
                    </div>
{{--                    <div class="text-right py-2">--}}
{{--                        <a href="#" class="btn btn-blms btn-sm pull-right">View More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="bot-links">--}}
{{--                        <a href="#">Sit amet</a>--}}
{{--                        <a href="#">Amet</a>--}}
{{--                        <a href="#">Lorem</a>--}}
{{--                        <a href="#">Ipsum dolor</a>--}}
{{--                        <a href="#">Lorem</a>--}}
{{--                        <a href="#">Amet</a>--}}
{{--                    </div>--}}
                </div>

            </div>
            <div class="col-md-12 py-2 my-3 text-center bg-dark">
                <h3 class="text-white">Chapter Videos</h3>
            </div>
            <div class="row">
                @foreach($chapter->videos as $video)
                <div class="col-md-12">
                    <div class="row course-strip">
                        <a href="{{route('website.chapter.videos', ['id'=>$video->id])}}">
                        <div class="col-md-12">
                            <h6>{{$video->name}}</h6>
                            <p>{{str_replace('*', ' ', $video->description)}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


@endsection
