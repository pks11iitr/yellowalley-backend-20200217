
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yellow Alley </title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


    <!-- Fonts icons -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    @yield('spreadsheets')

    <!-- =======================================================
      Theme Name: Yellow Alley
      Theme URL: yellowalley.com
      Author: Bnext-it
      Author URL: https://bnextitxolutions.com
    ======================================================= -->
</head>
<section class="header">
    <div class="top-menu bg-dark py-1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 py-2 hidden-sm-down d-sm-none d-md-block d-none d-sm-block">
				<span class="left">
				  <a href="tel:+91-99290304"><i class="fa fa-phone"></i></a>
				  <a href="#"><i class="fa fa-envelope"></i>info@yellowalley.com</a>
				</span>
                </div>
                <div class="col-md-8 py-2 col-sm-12 pull-right">
				<span class="right">

                      @if(auth()->user())
                    <a class="dropdown">
					  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> Hi {{ucwords(auth()->user()->name)}}
					  </a>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="transform: translate3d(641px, 30px, 0px);">
						<a class="dropdown-item" href="{{route('website.profile')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Profile</a>
						<a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
					  </div>
                    </a>
                      @else
                          <a href="{{route('login')}}" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> Sign In
					    </a>
                      @endif
					</a>
				</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-white">

                    <a class="navbar-brand" href="{{route('website.home')}}"><img class="logo" src="{{asset('img/logo.png')}}" alt="Yellow Alley logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-right navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{route('website.home')}}">Home</a></li>
                            <li class="nav-item active"><a class="nav-link" href="{{route('website.chapters')}}">Courses</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('website.certificate.info')}}">Certificate</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('website.submit.doubt')}}">Submit Your Doubt</a></li>


                            <!--<li class="nav-item">
                              <a class="btn btn-blms" href="#" data-target="#pricequote" data-image-id="" data-toggle="modal" tabindex="-1" aria-disabled="true">Submit Your Doubt</a>
                            </li> -->
                        </ul>
                    </div>
                    <a class="btn btn-blms btn-sm hidden-sm-down d-sm-none d-md-block d-none d-sm-block" href="{{route('website.payment.info')}}" >Pay Now</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<div>
    <?php //var_dump($errors->all());die;?>
    @if ($message = Session::get('success'))
        <div id="alert" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>

    @endif


    @if ($message = Session::get('error'))
        <div id="alert" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<script>
setTimeout(function() {
    $('.alert-success').fadeOut('slow');
}, 5000);
</script>
@yield('contents')

<!-- Footer Starts -->
<footer class="footer pt-4">
    <div class="container">
        <div class="container">
            <div class="row section">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <h3>About Yellow Alley</h3>
                    <p class="text-white text-justify">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                        <a href="pages/ab out">read more ></a>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <h3>Useful Links</h3>
                    <ul>
                        <li><a href="{{route('website.about.us')}}">About</a>
                        </li>
                        <li><a href="{{route('website.faqs')}}">Faq</a>
                        </li>
                        <li><a href="{{route('website.privacy')}}">Privacy Policy</a>
                        </li>
                        <li><a href="{{route('website.terms')}}">Term & Condition</a>
                        </li>
                        <li><a href="{{route('website.contact.us')}}">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-5 col-md-5 col-xs-12">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter to get the latest news.</p>
                    <form>
                        <div class="row clearfix">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <div class="form-group">
                                    <input type="email" class="form-control"  name="semail" placeholder="Enter your Email">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <input type="submit" class="form-control btn btn-filled btn-block" name="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="col-12">
                    <div class="footer-text text-center">
                        <ul class="social-icons">
                            <li>
                                <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a class="instagram" href="#"><i class="fa fa-instagram"></i></a>
                            </li>

                            <li>
                                <a class="instagram" href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a class="instagram" href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                        <p class="mb-3text-white">Copyright © 2020 Yellow Alley, All Right Reserved</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- Footer ends -->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5e69de8d8d24fc2265872657/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>

<script src="{{asset('js/form-validator.min.js')}}"></script>
<script src="{{asset('js/contact-form-script.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/webscript.js')}}"></script>

@yield('scripts')

</body>

</html>
