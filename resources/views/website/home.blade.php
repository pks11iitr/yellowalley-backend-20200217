@extends('website.layout')

@section('mainbody')
    <div id="mainBody">
        <div class="container">
            <div class="row">
                <!-- Sidebar ================================================== -->
                @include('website.sidebar')
                <!-- Sidebar end=============================================== -->
                <div class="span9">
                     <h4 class="heading">Featured Products </h4>
                    <ul class="thumbnails">
                        @foreach($featured as $product)

                        <li class="span3">
                            <form class="form-horizontal qtyFrm" action="{{route('website.addcart')}}" method="post" id="list-cart-form-{{$product->id}}">
                                @csrf
                                <input type="hidden" name="quantity" value="1" class="span1" placeholder="Qty."/>
                                <input type="hidden" name="product_id" value="{{$product->id}}" class="span1" placeholder="Qty."/>
                            <div class="thumbnail">
                                <a  href="{{route('website.product.details', ['id'=>$product->id])}}"><img src="{{asset($product->image)}}" alt=""/></a>
                                <div class="caption">
                                    <h5><a href="{{route('website.product.details', ['id'=>$product->id])}}">{{$product->name}}</a></h5>
									<p><span class="pricenew">₹ {{$product->price}}</span><span class="priceold">₹ {{$product->cut_price}}</span> {{!empty($product->cut_price)?'('.intval(100-$product->price*100/($product->cut_price)).'% OFF)':''}}</p>
									<p class="text-center">
										<a href="javascript:void(0)" class="btn" onclick="submitlistaddcart({{$product->id}})"> Add to <i class=" icon-shopping-cart"></i></a>
										<a class="btn" href="{{route('website.product.details', ['id'=>$product->id])}}">Buy Now</a>
									</p>
								</div>
                            </div>
                            </form>
                        </li>
                        @endforeach
                    </ul>

                    <h4 class="heading">Latest Products </h4>
                    <ul class="thumbnails">
                        @foreach($latest as $product)
                        <li class="span3">
                            <form class="form-horizontal qtyFrm" action="{{route('website.addcart')}}" method="post" id="list-cart-form-{{$product->id}}">
                            @csrf
                            <input type="hidden" name="quantity" value="1" class="span1" placeholder="Qty."/>
                            <input type="hidden" name="product_id" value="{{$product->id}}" class="span1" placeholder="Qty."/>
                            <div class="thumbnail">
                                <a  href="{{route('website.product.details', ['id'=>$product->id])}}"><img src="{{asset($product->image)}}" alt=""/></a>
                                <div class="caption">
									<h5><a href="{{route('website.product.details', ['id'=>$product->id])}}">{{$product->name}}</a></h5>
									<p><span class="pricenew">₹ {{$product->price}}</span><span class="priceold">₹ {{$product->cut_price}}</span> {{!empty($product->cut_price)?'('.intval(100-$product->price*100/($product->cut_price)).'% OFF)':''}}</p>
									<p class="text-center">
										<a href="javascript:void(0)" class="btn" onclick="submitlistaddcart({{$product->id}})"> Add to <i class=" icon-shopping-cart"></i></a>
										<a class="btn" href="{{route('website.product.details', ['id'=>$product->id])}}">Buy Now</a>
									</p>
                                    <!---<h5>{{$product->name}}</h5>
                                    <p>{{$product->company}}</p>
                                    <h4 style="text-align:center"><a class="btn" href="{{route('website.product.details', ['id'=>$product->id])}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">{{$product->price}}</a></h4> ---->
                                </div>
                            </div>
                            </form>
                        </li>
                        @endforeach
                    </ul>
					<p class="pull-right"><a href="" class="btn  btn-primary btn-small">View More</a></p>
                </div>
            </div>
        </div>
    </div>
    <script>

        function submitlistaddcart(id){
            $("#list-cart-form-"+id).submit()
        }
        function submitgridaddcart(id){
            $("#grid-cart-form-"+id).submit()
        }
    </script>

@endsection
