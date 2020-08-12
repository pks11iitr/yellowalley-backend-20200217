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
                               {{-- <div class="myVideo" id="my_videos" data-video="{{$video->video_url}}" data-type="video/mp4" data-poster="{{$video->image}}">--}}
                                <video width="100%" height="100%"  controls controlsList="nodownload" id="myvideo" poster="{{$video->image}}">
                                        <source src="{{$video->video_url}}" type="video/mp4">
                                    </video>

                               {{-- </div>--}}
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
    <script src="{{asset('js/rtop.videoPlayer.1.0.2.min.js')}}"></script>
    <script>

        $(document).ready(function(){
            $("#my_video").RTOP_VideoPlayer({
                showFullScreen: true,
                showTimer: true,
                showSoundControl: true,
            });
        });

    </script>
    <script>
        var elem = document.getElementById("myvideo");
        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        }
    </script>
    <style>
        div#video_player_box{ width:550px; background:#000; margin:0px auto;}
        div#video_controls_bar{ background: #333; padding:10px; color:#CCC;}
        input#seekslider{ width:180px; }
        input#volumeslider{ width: 80px;}
    </style>
    <script>
        var vid, playbtn, seekslider, curtimetext, durtimetext, mutebtn, volumeslider, fullscreenbtn;
        function intializePlayer(){
            // Set object references
            vid = document.getElementById("my_video");
            playbtn = document.getElementById("playpausebtn");
            seekslider = document.getElementById("seekslider");
            curtimetext = document.getElementById("curtimetext");
            durtimetext = document.getElementById("durtimetext");
            mutebtn = document.getElementById("mutebtn");
            volumeslider = document.getElementById("volumeslider");
            fullscreenbtn = document.getElementById("fullscreenbtn");
            // Add event listeners
            playbtn.addEventListener("click",playPause,false);
            seekslider.addEventListener("change",vidSeek,false);
            vid.addEventListener("timeupdate",seektimeupdate,false);
            mutebtn.addEventListener("click",vidmute,false);
            volumeslider.addEventListener("change",setvolume,false);
            fullscreenbtn.addEventListener("click",toggleFullScreen,false);
        }
        window.onload = intializePlayer;
        function playPause(){
            if(vid.paused){
                vid.play();
                playbtn.innerHTML = "Pause";
            } else {
                vid.pause();
                playbtn.innerHTML = "Play";
            }
        }
        function vidSeek(){
            var seekto = vid.duration * (seekslider.value / 100);
            vid.currentTime = seekto;
        }
        function seektimeupdate(){
            var nt = vid.currentTime * (100 / vid.duration);
            seekslider.value = nt;
            var curmins = Math.floor(vid.currentTime / 60);
            var cursecs = Math.floor(vid.currentTime - curmins * 60);
            var durmins = Math.floor(vid.duration / 60);
            var dursecs = Math.floor(vid.duration - durmins * 60);
            if(cursecs < 10){ cursecs = "0"+cursecs; }
            if(dursecs < 10){ dursecs = "0"+dursecs; }
            if(curmins < 10){ curmins = "0"+curmins; }
            if(durmins < 10){ durmins = "0"+durmins; }
            curtimetext.innerHTML = curmins+":"+cursecs;
            durtimetext.innerHTML = durmins+":"+dursecs;
        }
        function vidmute(){
            if(vid.muted){
                vid.muted = false;
                mutebtn.innerHTML = "Mute";
            } else {
                vid.muted = true;
                mutebtn.innerHTML = "Unmute";
            }
        }
        function setvolume(){
            vid.volume = volumeslider.value / 100;
        }
        function toggleFullScreen(){
            if(vid.requestFullScreen){
                vid.requestFullScreen();
            } else if(vid.webkitRequestFullScreen){
                vid.webkitRequestFullScreen();
            } else if(vid.mozRequestFullScreen){
                vid.mozRequestFullScreen();
            }
        }
    </script>
@endsection
