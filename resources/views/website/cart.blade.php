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
                        <li class="active"> SHOPPING CART</li>
                    </ul>
                    <h3>  SHOPPING CART [ <small>{{$cart['items']??0}} Item(s) </small>]<a href="{{env('APP_URL')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
                    <hr class="soft"/>
{{--                    <table class="table table-bordered">--}}
{{--                        <tr><th> I AM ALREADY REGISTERED  </th></tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <form class="form-horizontal">--}}
{{--                                    <div class="control-group">--}}
{{--                                        <label class="control-label" for="inputUsername">Username</label>--}}
{{--                                        <div class="controls">--}}
{{--                                            <input type="text" id="inputUsername" placeholder="Username">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="control-group">--}}
{{--                                        <label class="control-label" for="inputPassword1">Password</label>--}}
{{--                                        <div class="controls">--}}
{{--                                            <input type="password" id="inputPassword1" placeholder="Password">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="control-group">--}}
{{--                                        <div class="controls">--}}
{{--                                            <button type="submit" class="btn">Sign in</button> OR <a href="register.html" class="btn">Register Now!</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="control-group">--}}
{{--                                        <div class="controls">--}}
{{--                                            <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Quantity/Update</th>
                            <th>Price</th>
                            <th>Delivery</th>
{{--                            <th>Tax</th>--}}
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart['cart'] as $c)
                        <tr>
                            <td> <img width="60" src="{{$c->product->image}}" alt=""/></td>
                            <td><b>Product Name</b><br/>{{$c->product->name}}</td>
                            <td>
                                <div class="input-append">
                                    <input class="span1" style="max-width:34px" value="{{$c->quantity}}" id="quantity-{{$c->product_id}}" size="16" type="text">
                                    <button class="btn" type="button" onclick="updatecart({{$c->product_id}}, 'decrement')"><i class="icon-minus"></i></button>
                                    <button class="btn" type="button"><i class="icon-plus" onclick="updatecart({{$c->product_id}},'increment')"></i></button>
                                    <button class="btn btn-danger" type="button" onclick="deletecart({{$c->product_id}})"><i class="icon-remove icon-white"></i></button>
                                </div>
                            </td>
                            <td>{{$c->product->price*$c->quantity}}</td>
                            <td>{{ceil($c->product->product_weight*$c->quantity)*$c->product->delivery_per_kg_price}}</td>
{{--                            <td>$15.00</td>--}}
                            <td>{{$c->product->price*$c->quantity+ceil($c->product->product_weight*$c->quantity)*$c->product->delivery_per_kg_price}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align:right">Total Price:	</td>
                            <td>{{$cart['price_total']??0}}</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right">Delivery Charges:	</td>
                            <td>{{$cart['delivery']??0}}</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:right"><strong>TOTAL ({{$cart['price_total']??0}} - {{$cart['delivery']}}) =</strong></td>
                            <td class="label label-important" style="display:block"> <strong> {{$cart['total']}}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                    <form method="post" id="cart-form" style="display:none" action="{{route('website.addcart')}}">
                        @csrf
                        <input type="hidden" id="cart-quantity" name="quantity" value="1" class="span1" placeholder="Qty."/>
                        <input type="hidden" id="cart-product" name="product_id" value="" class="span1" placeholder="Qty."/>
                    </form>
                    <script>
                        function updatecart(id, type){
                            $("#cart-product").val(id)
                            if(type=='increment'){
                                quantity=$("#quantity-"+id).val()
                                // /alert(quantity)
                                quantity=parseInt(quantity)+1;
                                $("#quantity-"+id).val(quantity)
                                $("#cart-quantity").val(quantity)
                                $("#cart-form").submit()
                            }else{
                                quantity=$("#quantity-"+id).val()
                                if(parseInt(quantity)>0){
                                    quantity=parseInt(quantity)-1;
                                    $("#quantity-"+id).val(quantity)
                                    $("#cart-quantity").val(quantity)
                                    $("#cart-form").submit()
                                }

                            }
                        }

                        function deletecart(id){
                            $("#cart-product").val(id)
                            $("#cart-quantity").val(0)
                            $("#cart-form").submit()
                        }
                    </script>
{{--                    <table class="table table-bordered">--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <form class="form-horizontal">--}}
{{--                                    <div class="control-group">--}}
{{--                                        <label class="control-label"><strong> VOUCHERS CODE: </strong> </label>--}}
{{--                                        <div class="controls">--}}
{{--                                            <input type="text" class="input-medium" placeholder="CODE">--}}
{{--                                            <button type="submit" class="btn"> ADD </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    <table class="table table-bordered">--}}
{{--                        <tr><th>ESTIMATE YOUR SHIPPING </th></tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <form class="form-horizontal">--}}
{{--                                    <div class="control-group">--}}
{{--                                        <label class="control-label" for="inputCountry">Country </label>--}}
{{--                                        <div class="controls">--}}
{{--                                            <input type="text" id="inputCountry" placeholder="Country">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="control-group">--}}
{{--                                        <label class="control-label" for="inputPost">Post Code/ Zipcode </label>--}}
{{--                                        <div class="controls">--}}
{{--                                            <input type="text" id="inputPost" placeholder="Postcode">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="control-group">--}}
{{--                                        <div class="controls">--}}
{{--                                            <button type="submit" class="btn">ESTIMATE </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
                    <a href="{{env('APP_URL')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
                    @if(auth()->user())
                    <a href="{{route('website.make.order')}}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
                    @else
                        <a href="#login" data-toggle="modal" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
