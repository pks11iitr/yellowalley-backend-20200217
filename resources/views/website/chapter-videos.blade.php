@extends('website.layout')
@section('spreadsheets')
    <link rel="stylesheet" href="{{asset('css/rtop.videoPlayer.1.0.2.min.css')}}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"crossorigin="anonymous"/>
@endsection
@section('contents')
    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="">{{$chapter->title}}
                        </h4>
                </div>
                @if($chapter->sequence_no>1)
                <div class="col-md-3 text-right">
                    <a href="{{route('website.start.test', ['id'=>$chapter->id])}}" class="btn btn-yellow btn-sm">Take Test</a>
                </div>
                    @endif
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="big-video-testimonial-block">
{{--                                <div class="video-thumbnail"><img src="img/glry/img1.jpg" alt="" class="img-fluid"></div>--}}
{{--                                <div class="myVideo" id="my_video" data-video="{{$video->video_url}}" data-type="video/mp4" data-poster="{{$video->image}}">--}}
{{--                                </div>--}}
                                <video id='video1' width="640" height="360" poster="{{$video->image}}">
                                    <source src="{{$video->video_url}}">
                                </video>
                            </div>
                        </div>
                        <div class="col-md-12 py-4">
                            <div class="section-title mb-4">
                                <h3>{{$video->name}}</h3>
                            </div>
                            <div class="about-content">
                                <p class="text-justify">{{$video->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="py-2">Chapter Sessions</h4>
                    @foreach($chapter->videos as $v)
                        <a href="{{route('website.chapter.videos', ['id'=>$v->id])}}">
                        <div class="row course-strip">
                            <div class="col-md-12">
                                <h6>{{$v->name}}</h6>
{{--                                <p>Basic of controllers</p>--}}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

@endsection


@section('scripts')
{{--    <script src="{{asset('js/rtop.videoPlayer.1.0.2.min.js')}}"></script>--}}
    <script src="{{asset('js/video-extend.js')}}"></script>
    <script>

        // $(document).ready(function(){
        //     $("#my_video").RTOP_VideoPlayer({
        //         showFullScreen: true,
        //         showTimer: true,
        //         showSoundControl: true,
        //         autoPlay:true
        //     });
        // });



        $(document).ready(function(){

            $('#video1').videoExtend({
                responsive: true,
                autoPlay: true
            })

        });

    </script>
@endsection
