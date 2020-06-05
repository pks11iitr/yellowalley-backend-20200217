@extends('website.layout')

@section('contents')



    <section class="breadcrumb m-0 bg-blms py-4">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4 class="">Chapters</h4>
			</div>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<div class="row">
            @foreach($chapterarr as $chapter)
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 py-2 mb-3">
                <div class="video-testimonial-block">
                    <div class="video-thumbnail"><a href="{{route('website.chapter.details', ['id'=>$chapter->id])}}"><img src="{{$chapter->image}}" alt="" class="img-fluid"></a></div>
                    @if($chapter->lock_status['status']=='locked')
                        <a href="{{route('website.chapter.details', ['id'=>$chapter->id])}}" class="video-icon-lock"><i class="fa fa-lock"></i></a>
                    @endif
{{--                        <a href="#" class="video-icon"><i class="fa fa-eye"></i></a>--}}
                </div>
                <div class="video-testimonial-content text-center">
                    <a href="{{route('website.chapter.details', ['id'=>$chapter->id])}}"><h6 class="mb10">{{$chapter->title}}</h6></a>
                </div>
            </div>
            @endforeach
		</div>
{{--		<div class="row">--}}
{{--			<div class="col-md-12 d-flex justify-content-center">--}}
{{--				<nav aria-label="Page navigation example">--}}
{{--				  <ul class="pagination">--}}
{{--					<li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
{{--					<li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--					<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--					<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--					<li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
{{--				  </ul>--}}
{{--				</nav>--}}
{{--			</div>--}}
{{--		</div>--}}
	</div>
</section>

@endsection
