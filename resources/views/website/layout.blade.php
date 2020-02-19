<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bootshop online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Less styles -->
    <!-- Other Less css file //different less files has different color scheam
     <link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
     <link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
     <link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
     -->
    <!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
    <script src="themes/js/less.js" type="text/javascript"></script> -->

    <!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="{{asset('vendor/themes/bootshop/bootstrap.min.css')}}" media="screen"/>
    <link href="{{asset('vendor/themes/css/base.css')}}" rel="stylesheet" media="screen"/>
    <!-- Bootstrap style responsive -->
    <link href="{{asset('vendor/themes/css/bootstrap-responsive.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('vendor/themes/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="{{asset('vendor/themes/js/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="{{asset('vendor/themes/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('vendor/themes/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('vendor/themes/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('vendor/themes/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('vendor/themes/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <style type="text/css" id="enject"></style>
</head>
<body>
<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            <div class="span6">Welcome! <strong>{{ucfirst(auth()->user()->name?? 'User')}}</strong></div>
            <div class="span6">
                <div class="pull-right">
                    <a href="{{route('website.cartdetails')}}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{$cart['items']??0}} ] Items in your cart </span> </a>
                </div>
            </div>
        </div>
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner">
                <a class="brand" href="{{env('APP_URL')}}"><img src="{{asset('vendor/themes/images/logo.png')}}" alt="Bootsshop"/></a>
                <form class="form-inline navbar-search" method="post" action="" >
                    <input id="srchFld" class="srchTxt" type="text" />

                    <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
                </form>
                <ul id="topMenu" class="nav pull-right">
                    <li class=""><a href="{{route('website.specials.offer')}}">Specials Offer</a></li>
                    <li class=""><a href="{{route('website.contact')}}">Contact</a></li>
                    @if(empty(auth()->user()))
                        <li class="">
                        <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-primary">Login</span></a>
                        <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="loginmodal modal-body">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 class="text-center">Login</h3>
									<form class="loginform form-horizontal loginFrm" action="{{route('login')}}" method="post">
									@csrf
										<div class="control-group">
											<input type="text" name="mobile" id="inputEmail" placeholder="Email">
										</div>
										<div class="control-group">
											<input type="password" name="password"  id="inputPassword" placeholder="Password">
										</div>
										<div class="control-group">
											<label class="checkbox">
												<input type="checkbox"> Remember me
											</label>
										</div>
										<div class="control-group">
										<button type="submit" class="btn-login btn btn-block">Sign in</button>
										</div>
									</form>

                            </div>
                        </div>
                    </li>
                        <li class="">
                            <a href="#register" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-primary">Register</span></a>
                            <div id="register" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="loginmodal modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 class="text-center">Login</h3>
                                    <form class="loginform form-horizontal loginFrm" action="{{route('register')}}" method="post">
                                        @csrf
                                        <div class="control-group">
                                            <input type="text" name="name"  placeholder="Name">
                                        </div>
                                        <div class="control-group">
                                            <input type="text" name="mobile"  placeholder="Mobile">
                                        </div>
                                        <div class="control-group">
                                            <input type="password" name="password"  placeholder="Password">
                                        </div>
                                        <div class="control-group">
                                            <input type="email" name="email"   placeholder="Email(optional)">
                                        </div>
                                        <div class="control-group">
                                            <button type="submit" class="btn-login btn btn-block">Sign up</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </li>
                    @else

                        <li class=""><a href="{{route('website.order.history')}}">My Orders</a></li>
                        <li class=""><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Header End====================================================================== -->
@if(isset($banners))
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            @foreach($banners as $banner)
            <div class="item @if($loop->iteration==1){{'active'}}@endif">
                <div class="container">
                    <a href="register.html"><img style="width:100%" src="{{asset($banner->doc_path)}}" alt="special offers"/></a>
                    <div class="carousel-caption">
                        <h4>Second Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
@endif
</div>
<div id="errors">
    @if (($message = Session::get('error')) || $errors->has('mobile'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message??$errors->first('mobile') }}</strong>
        </div>
    @endif
</div>
@yield('mainbody')
<!-- Footer ================================================================== -->
<div  id="footerSection">
    <div class="container">
        <div class="row">
            <div class="span3">
                <h5>ACCOUNT</h5>
                <a href="login.html">YOUR ACCOUNT</a>
                <a href="login.html">PERSONAL INFORMATION</a>
                <a href="login.html">ADDRESSES</a>
                <a href="login.html">DISCOUNT</a>
                <a href="login.html">ORDER HISTORY</a>
            </div>
            <div class="span3">
                <h5>INFORMATION</h5>
                <a href="contact.html">CONTACT</a>
                <a href="register.html">REGISTRATION</a>
                <a href="legal_notice.html">LEGAL NOTICE</a>
                <a href="tac.html">TERMS AND CONDITIONS</a>
                <a href="faq.html">FAQ</a>
            </div>
            <div class="span3">
                <h5>OUR OFFERS</h5>
                <a href="#">NEW PRODUCTS</a>
                <a href="#">TOP SELLERS</a>
                <a href="special_offer.html">SPECIAL OFFERS</a>
                <a href="#">MANUFACTURERS</a>
                <a href="#">SUPPLIERS</a>
            </div>
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA </h5>
                <a href="#"><img width="60" height="60" src="{{asset('vendor/themes/images/facebook.png')}}" title="facebook" alt="facebook"/></a>
                <a href="#"><img width="60" height="60" src="{{asset('vendor/themes/images/twitter.png')}}" title="twitter" alt="twitter"/></a>
                <a href="#"><img width="60" height="60" src="{{asset('vendor/themes/images/youtube.png')}}" title="youtube" alt="youtube"/></a>
            </div>
        </div>
        <div style="text-align:center;margin-top:20px;">© Bootshop</div>
    </div><!-- Container End -->
</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{asset('vendor/themes/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/themes/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/themes/js/google-code-prettify/prettify.js')}}"></script>

<script src="{{asset('vendor/themes/js/bootshop.js')}}"></script>
<script src="{{asset('vendor/themes/js/jquery.lightbox-0.5.js')}}'"></script>
</body>
</html>
