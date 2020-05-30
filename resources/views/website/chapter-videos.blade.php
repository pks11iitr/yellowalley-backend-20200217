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
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="big-video-testimonial-block">
                                <div class="video-thumbnail"><img src="img/glry/img1.jpg" alt="" class="img-fluid"></div>
                                <div class="video">
                                    <iframe src="https://www.youtube.com/embed/KEiAVv1UNac" allowfullscreen>
                                    </iframe>
                                </div>
                                <a href="#" class="video-icon"><i class="fa fa-play"></i></a>
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
                    <h4 class="py-2">Chapter Videos</h4>
                    @foreach($chapter->videos as $v)
                    <a href="#">
                        <div class="row course-strip">
                            <div class="col-md-8">
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

@endsection
