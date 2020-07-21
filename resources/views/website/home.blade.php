@extends('website.layout')

@section('contents')

    <!-- Slider Section Starts -->
    <section class="carousel">
        <div id="light-slider" class="carousel slide">
            <div id="carousel-area">
                <div id="carousel-slider" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-slider" data-slide-to="1"></li>
                        <li data-target="#carousel-slider" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($banners as $banner)

                        <div class="carousel-item slider-img @if($loop->iteration==1){{'active'}}@endif">
                            <img src="{{$banner->doc_path}}" class="img-fluid" alt="">

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video-testimonial-section -->
    <section  class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- section-title -->
                    <!-- <div class="section-title">
                        <span class="h2">Recent View</h2></span><span class="pull-right"></span>

                    </div> -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="section-title">
                        <span class="h2">Recent View</h2></span><span class="pull-right"></span>

                    </div>
                    <div class="big-video-testimonial-block">
                        <div class="video-thumbnail"><img src="{{$lastvideo->image}}" alt="" class="img-fluid"></div>
                        <div class="video">

                        </div>
                        <a href="{{route('website.chapter.videos', [$lastvideo->id])}}" class="video-icon"><i class="fa fa-play"></i></a>
                    </div>
                    <div class="video-testimonial-content text-center py-3">
                        <h4 class="mb10">{{$lastvideo->name}}</h4>
                    </div>
                </div>
                <div class="col-md-6 pull-left p-2  justify-content-center ans_con">
                <span class="h2">Questions Answered</h2></span><span class="pull-right"></span>
                    <div class="circle-block py-5" style="height=250px; width:250px;margin:0 auto">
                        <div class="circle">
                            {{$userscore}}/{{$totalscore}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- video-testimonial-section -->
    <!-- video-testimonial-section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- section-title -->
                    <div class="section-title">
                        <span class="h2">Chapter</h2></span><span class="pull-right"><a href="{{route('website.chapters')}}">See All</a></h2></span>
                    </div>
                </div>
                <!-- /.section-title -->
            </div>
            <div class="row">
                <!-- video-testimonail -->

                <!-- /.video-testimonail -->
                <!-- video-testimonail -->
                @foreach($videos->videos as $video)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 py-2 mb-3">
                    <div class="video-testimonial-block">
                        <div class="video-thumbnail">
                            <img src="{{$video->image}}" alt="" class="img-fluid">
                        </div>
                        <a href="{{route('website.chapter.videos', [$lastvideo->id])}}" class="video-icon"><i class="fa fa-play"></i></a>
                    </div>
                    <div class="video-testimonial-content text-center ">
                        <h4 class="mb10">{{$video->name}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /.video-testimonial-section -->

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $("#posts-carousel-3col").owlCarousel({
                items: 3,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]
            });

        });
    </script>
    <style type="text/css">
        .video-testimonial-content h4 {
            font-size: 20px;
            font-family: "rubik", sans-serif;
            font-weight: 500;
            text-align: center;
        }
    </style>

@endsection
