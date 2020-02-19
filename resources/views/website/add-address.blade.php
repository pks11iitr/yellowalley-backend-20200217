@extends('website.layout')

@section('mainbody')

    <div id="mainBody">
        <div class="container">
            <div class="row">
                <!-- Sidebar end=============================================== -->
                @include('website.sidebar')
                <div class="span9">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                        <li class="active"> Update Adderss</li>
                    </ul>
                    <h3>  Order Summary [ <small>{{count($order->details)}} Item(s) </small>]</h3>
                    <hr class="soft"/>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Delivery</th>
                            {{--                            <th>Tax</th>--}}
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->details as $c)
                            <tr>
                                <td> <img width="60" src="{{$c->product->image}}" alt=""/></td>
                                <td><b>Product Name</b><br/>{{$c->product->name}}</td>
                                <td>{{$c->product->price*$c->quantity}}</td>
                                <td>{{ceil($c->product->product_weight*$c->quantity)*$c->product->delivery_per_kg_price}}</td>
                                {{--                            <td>$15.00</td>--}}
                                <td>{{$c->product->price*$c->quantity+ceil($c->product->product_weight*$c->quantity)*$c->product->delivery_per_kg_price}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align:right"><strong>TOTAL</strong></td>
                            <td class="label label-important" style="display:block"> <strong> {{$order->total_paid}}</strong></td>
                        </tr>
                        </tbody>
                    </table>


                                        <table class="table table-bordered">
                                            <tr><th>ESTIMATE SHIPPING DETAILS </th></tr>
                                            <tr>
                                                <td>
                                                    <form class="form-horizontal" action="{{route('website.confirmnpay', ['id'=>$order->id])}}">
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputCountry">Name </label>
                                                            <div class="controls">
                                                                <input type="text" name="name" placeholder="name" required value="{{$shipping->name??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputPost">Mobile</label>
                                                            <div class="controls">
                                                                <input type="text" name="mobile" placeholder="mobile" required value="{{$shipping->mobile??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputCountry">GST NO </label>
                                                            <div class="controls">
                                                                <input type="text" name="gst_no" placeholder="gst no." required value="{{$shipping->gst_no??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputCountry">Courier Service Name</label>
                                                            <div class="controls">
                                                                <input type="text" name="courier_service" placeholder="courier service" value="{{$shipping->courier_service??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputPost">Company Name</label>
                                                            <div class="controls">
                                                                <input type="text" name="company_name" placeholder="company name" required value="{{$shipping->company_name??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputCountry">Company Address</label>
                                                            <div class="controls">
                                                                <input type="text" name="company_address" placeholder="company address" required value="{{$shipping->company_address??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputPost" >Company Pincode</label>
                                                            <div class="controls">
                                                                <input type="text" name="company_pincode" placeholder="company pincode" required value="{{$shipping->company_pincode??''}}">
                                                            </div>
                                                        </div> <div class="control-group">
                                                            <label class="control-label" for="inputCountry">Company City</label>
                                                            <div class="controls">
                                                                <input type="text" name="company_city" placeholder="company city" required value="{{$shipping->company_city??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputPost">Shipping Address</label>
                                                            <div class="controls">
                                                                <input type="text" name="shipping_address" placeholder="shipping address" required value="{{$shipping->shipping_address??''}}">
                                                            </div>
                                                        </div> <div class="control-group">
                                                            <label class="control-label" for="inputCountry">Shipping Pincode</label>
                                                            <div class="controls">
                                                                <input type="text" name="shipping_pincode" placeholder="shipping pincode" required value="{{$shipping->shipping_pincode??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputPost">Shipping City</label>
                                                            <div class="controls">
                                                                <input type="text" name="shipping_city" placeholder="shipping city" required value="{{$shipping->shipping_city??''}}">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <button type="submit" class="btn">Confirm And Pay</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
