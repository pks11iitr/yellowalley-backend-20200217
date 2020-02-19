@extends('website.layout')

@section('mainbody')
    <div id="mainBody">
        <div class="container">
            <div class="row">
				<div class="span12">
					<ul class="breadcrumb">
                        <li><a href="{{env('APP_URL')}}">Home</a> <span class="divider">/</span></li>
                        <li><a href="{{route('website.category.product', ['id'=>$productdetails->id])}}">Products</a> <span class="divider">/</span></li>
                        <li class="active">{{$productdetails->name}}</li>
                    </ul>
				</div>
                <!-- Sidebar ================================================== -->
            @include('website.sidebar')
                <!-- Sidebar end=============================================== -->
                <div class="span9">

                    <div class="row">
                        <div id="gallery" class="span3">
                            <a href="themes/images/products/large/f1.jpg" title="Fujifilm FinePix S2950 Digital Camera">
                                <img src="{{asset($productdetails->image)}}" style="width:100%" alt="Fujifilm FinePix S2950 Digital Camera"/>
                            </a>

                        </div>
                        <div class="span6">
                            <h3>{{$productdetails->name}}  </h3>
                            <small>{{$productdetails->company}}</small>
                            <hr class="soft"/>
                            <form class="form-horizontal qtyFrm" action="{{route('website.addcart')}}" method="post">
                                @csrf
                                <div class="control-group">
									<p><span class="pricenew" style="font-size:18px;"><strong>Discount Price: </strong>{{$productdetails->price}}</span><button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button></p>
									<p><span class="priceold" style="margin-left:0; margin-right:10px;"><strong>Price: </strong>{{$productdetails->cut_price}}</span> {{!empty($productdetails->cut_price)?'('.intval(100-$productdetails->price*100/($productdetails->cut_price)).'% OFF)':''}}</p>

                                    <div class="controls">
                                        <input type="hidden" name="quantity" value="{{$productdetails->quantity??1}}" class="span1" placeholder="Qty." />
                                        <input type="hidden" name="product_id" value="{{$productdetails->id}}" class="span1" placeholder="Qty."/>

                                    </div>
                                </div>
                            </form>

                            <hr class="soft clr"/>
                            <p>{{$productdetails->description}}</p>
                            <br class="clr"/>
                            <a href="#" name="detail"></a>
                            <hr class="soft"/>
                        </div>

                        <div class="span9">
                            <ul id="productDetail" class="nav nav-tabs">

                                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
                                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <h4>Product Information</h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                                        <tr class="techSpecRow"><td class="techSpecTD1">Name: </td><td class="techSpecTD2">{{$productdetails->name}}</td></tr>

                                        <tr class="techSpecRow"><td class="techSpecTD1">Company:</td><td class="techSpecTD2">{{$productdetails->company}}</td></tr>

                                        <tr class="techSpecRow"><td class="techSpecTD1">Discount Price:</td><td class="techSpecTD2">{{$productdetails->price}}</td></tr>

                                        <tr class="techSpecRow"><td class="techSpecTD1">Price:</td><td class="techSpecTD2">{{$productdetails->cut_price}}</td></tr>

{{--                                        <tr class="techSpecRow"><td class="techSpecTD1">Size:</td><td class="techSpecTD2">{{$productdetails->size??0}}</td></tr>--}}

                                        <tr class="techSpecRow"><td class="techSpecTD1">Description:</td><td class="techSpecTD2">{{$productdetails->description}}</td></tr>

                                        <tr class="techSpecRow"><td class="techSpecTD1">In The Box:</td><td class="techSpecTD2">{{$productdetails->in_the_box}}</td></tr>

{{--                                        <tr class="techSpecRow"><td class="techSpecTD1">Released Date:</td><td class="techSpecTD2">{{$productdetails->created_at}}</td></tr>--}}

                                        </tbody>
                                    </table>

{{--                                    <h4>Editorial Reviews</h4>--}}
{{--                                    <h5>Manufacturer's Description </h5>--}}
{{--                                    <p>--}}
{{--                                        With a generous 18x Fujinon optical zoom lens, the S2950 really packs a punch, especially when matched with its 14 megapixel sensor, large 3.0" LCD screen and 720p HD (30fps) movie capture.--}}
{{--                                    </p>--}}

                                </div>
                                <div class="tab-pane fade" id="profile">

                                    <br class="clr"/>
                                    <hr class="soft"/>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="blockView">
                                            <ul class="thumbnails">
                                                @foreach($similar as $s)
                                                <li class="span3">
                                                    <div class="thumbnail">
                                                        <a href="{{route('website.product.details', ['id'=>$s->id])}}"><img src="{{$s->image}}" alt=""/></a>
                                                        <div class="caption">
                                                            <h5>{{$s->name}}</h5>
                                                            <p>
                                                                {{$s->company}}
                                                            </p>
                                                            <div class="caption">
                                                                <p><span class="pricenew">₹ {{$s->price}}</span><span class="priceold">₹ {{$s->cut_price}}</span> {{!empty($s->cut_price)?'('.intval(100-$s->price*100/($s->cut_price)).'% OFF)':''}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <hr class="soft"/>
                                        </div>
                                    </div>
                                    <br class="clr">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> </div>
    </div>
    <!-- MainBody End ============================= -->
@endsection
