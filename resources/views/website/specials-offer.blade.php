@extends('website.layout')

@section('mainbody')

    <div id="mainBody">
        <div class="container">
            <div class="row">
				<div class="span12">
					<ul class="breadcrumb">
						<li><a href="{{env('APP_URL')}}">Home</a> <span class="divider">/</span></li>
						<li class="active">Special offers</li>
					</ul>
				</div>
                <!-- Specials offer=============================================== -->
                @include('website.sidebar')

                <div class="span9">

    <h4>Special Offers<small class="pull-right"> 40 products are available </small></h4>
    <hr class="soft"/>
    <form class="form-horizontal span6">
{{--        <div class="control-group">--}}
{{--            <label class="control-label alignL">Sort By </label>--}}
{{--            <select>--}}
{{--                <option>Priduct name A - Z</option>--}}
{{--                <option>Priduct name Z - A</option>--}}
{{--                <option>Priduct Stoke</option>--}}
{{--                <option>Price Lowest first</option>--}}
{{--            </select>--}}
{{--        </div>--}}
    </form>
    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div>
    <br class="clr"/>
                    <div class="tab-content" style="margin-top:20px;">
                        <div class="tab-pane" id="listView">
                            @foreach($productsall as $productall)
                                <div class="row">
                                <div class="span2">
                                    <a href="{{route('website.product.details', ['id'=>$productall->id])}}"><img src="{{asset($productall->image)}}" alt=""/></a>
                                </div>
                                <div class="span4">
                                    <h3><a href="{{route('website.product.details', ['id'=>$productall->id])}}">"{{$productall->name}}</a></h3>
                                    <hr class="soft"/>
                                    <h5>{{$productall->company}}</h5>
                                    <p>
                                        {{substr($productall->description,0, 110)}}
                                    </p>
                                    <a class="btn btn-small pull-right" href="{{route('website.product.details', ['id'=>$productall->id])}}">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm" action="{{route('website.addcart')}}" method="post" id="list-cart-form-{{$productall->id}}">
                                        @csrf
                                        <p><span class="pricenew" style="font-size:18px;">₹ {{$productall->price}}</span><span class="priceold">₹ {{$productall->cut_price}}</span></br> {{!empty($productall->cut_price)?'('.intval(100-$productall->price*100/($productall->cut_price)).'% OFF)':''}}</p>

                                            <br/>
                                        <input type="hidden" name="quantity" value="1" class="span1" placeholder="Qty."/>
                                        <input type="hidden" name="product_id" value="{{$productall->id}}" class="span1" placeholder="Qty."/>
                                        <a href="javascript:void(0)" class="btn" onclick="submitlistaddcart({{$productall->id}})"> Add to <i class=" icon-shopping-cart"></i></a>
										<a class="btn" href="{{route('website.product.details', ['id'=>$productall    ->id])}}">Buy Now</a>
                                    </form>
                                </div>
                                <script>

                                    function submitlistaddcart(id){
                                        $("#list-cart-form-"+id).submit()
                                    }

                                </script>
                            </div>
                            <hr class="soft"/>
                            @endforeach
                        </div>

                        <div class="tab-pane  active" id="blockView">
                            <ul class="thumbnails">
                                @foreach($productsall as $productall)
                                   <li class="span3">
									<div class="thumbnail">
										<a  href="{{route('website.product.details', ['id'=>$productall->id])}}"><img src="{{asset($productall->image)}}" alt=""/></a>
										<div class="caption">
											<h5><a href="{{route('website.product.details', ['id'=>$productall->id])}}">{{$productall->name}}</a></h5>
											<p><span class="pricenew">₹ {{$productall->price}}</span><span class="priceold">₹ {{$productall->cut_price}}</span> {{!empty($productall->cut_price)?'('.intval(100-$productall->price*100/($productall->cut_price)).'% OFF)':''}}</p>
											<p class="text-center">
												<a href="javascript:void(0)" class="btn" onclick="submitlistaddcart({{$productall->id}})"> Add to <i class=" icon-shopping-cart"></i></a>
												<a class="btn" href="{{route('website.product.details', ['id'=>$productall->id])}}">Buy Now</a>
											</p>
										</div>
									</div>
								</li>
                                @endforeach
                                <script>

                                    function submitgridaddcart(id){
                                        $("#grid-cart-form-"+id).submit()
                                    }

                                </script>
                            </ul>
                            <hr class="soft"/>
                        </div>
                    </div>
    <div class="pagination">
{{--        <ul>--}}
{{--            <li><a href="#">&lsaquo;</a></li>--}}
{{--            <li><a href="#">1</a></li>--}}
{{--            <li><a href="#">2</a></li>--}}
{{--            <li><a href="#">3</a></li>--}}
{{--            <li><a href="#">4</a></li>--}}
{{--            <li><a href="#">...</a></li>--}}
{{--            <li><a href="#">&rsaquo;</a></li>--}}
{{--        </ul>--}}
        {{$productsall->links()}}
    </div>
    <br class="clr"/>
</div>
            </div>
        </div>
    </div>
@endsection
