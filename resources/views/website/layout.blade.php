
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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


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


<div class="top-menu bg-dark py-1 mobile_header">
        <div class="container ">
        <div class="top_header ralewy_font top_mobile_header">
        <div class="first_info">
        <ul>
        <li><i class="fa fa-map-marker" aria-hidden="true"></i>ANSARI ROAD, NEW DELHI - 110002</li>
        </ul>
        </div>
        <div class="first_info">
        <ul>
       
        <li><i class="fa fa-phone" aria-hidden="true"></i>8595205921</li>
        <li> <a href="#" class="email_cls"><i class="fa fa-envelope"></i>info@yellowalley.com</a></li>
        </ul>
        </div>
        <div class="social_login_con">
        <div class="social_icon">
        <ul>
        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
        </ul>
        </div>
        <div class="login_conta">
        <span class="right">

                      @if(auth()->user())
                    <a class="dropdown">
					  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> Hi {{ucwords(auth()->user()->name)}}
					  </a>
					  <div class="dropdown-menu" style = "transform: none !important;">
                          <a class="dropdown-item" href="{{route('website.profile')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Home</a>
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
                          LogIn
					    </a>
                      @endif
					</a>
				</span>
        </div>

        </div>
        
        
        </div>

        </div>
    </div>



    <div class="top-menu bg-dark py-1 desktop_header">
        <div class="container ">

        <div class="top_header ralewy_font">
        <div class="first_info">
        <ul>
        <li><i class="fa fa-map-marker" aria-hidden="true"></i>ANSARI ROAD, NEW DELHI - 110002</li>
        <li><i class="fa fa-phone" aria-hidden="true"></i>8595205921</li>
        <li> <a href="#" class="email_cls"><i class="fa fa-envelope"></i>info@yellowalley.com</a></li>
        </ul>
        </div>
        <div class="social_icon">
        <ul>
        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
        </ul>
        </div>
        <div class="login_conta">
        <span class="right">

                      @if(auth()->user())
                    <a class="dropdown">
					  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> Hi {{ucwords(auth()->user()->name)}}
					  </a>
					  <div class="dropdown-menu" style = "transform: none !important;">
                          <a class="dropdown-item" href="{{route('website.profile')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Home</a>
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
                          LogIn
					    </a>
                      @endif
					</a>
				</span>
        </div>
        </div>

        </div>
    </div>
    <div class="container nav1">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-white custom_menu cizel_font">

                    <a class="navbar-brand" href="http://yellowalley.org"><img class="logo" src="{{asset('img/logo.png')}}" alt="Yellow Alley logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-right navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item my_menu"><a class="nav-link active" href="http://yellowalley.org">Home</a></li>
                            <li class="nav-item my_menu"><a class="nav-link" href="{{route('website.chapters')}}">Course</a></li>
                            <li class="nav-item my_menu"><a class="nav-link" href="{{route('website.certificate.info')}}">Certificate</a></li>
                            <li class="nav-item my_menu"><a class="nav-link" href="{{route('website.submit.doubt')}}">Submit Your Doubts</a></li>
                            <li class="nav-item my_menu"><a class="nav-link" href="{{route('website.contact.us')}}">Contact Us</a></li>
                            <li class="nav-item"> <a class="btn btn-blms btn-sm hidden-sm-down d-sm-none d-md-block d-none d-sm-block" href="{{route('website.payment.info')}}" >Pay Now</a></li>
                            <li class="search_con menu-item menu-item-search">
                                <span><i class="fa fa-search my_search"></i></span>
                                <div class="minisearch invert"><form role="search" id="searchform" class="sf" action="http://yellowalley.org/" method="GET"><input id="searchform-input" class="sf-input" type="text" name="s" placeholder="Search..." name="s"><span class="sf-submit-icon"><i class="fa fa-search" aria-hidden="true"></i>
</span><input id="searchform-submit" class="sf-submit" type="submit" value=""></form></div>
                            </li>


                            <!--<li class="nav-item">
                              <a class="btn btn-blms" href="#" data-target="#pricequote" data-image-id="" data-toggle="modal" tabindex="-1" aria-disabled="true">Submit Your Doubt</a>
                            </li> -->
                        </ul>
                    </div>

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
<footer class="footer">
    <div class="container">



        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="col-md-12 col-xs-12 text-center about_cmp">
                    <span class="footer_log"><img src="http://study.yellowalley.local/img/logo.png" alt=""></span>
                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book. read more >

</p>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <h4 class="footer_heading">CONTACT FORM</h4>
                <div class="form_container">
                    <p><input type="text" placeholder="Your Name" class="in_fld"></p>
                    <p><input type="text" placeholder="Your Email" class="in_fld"></p>
                    <p><textarea name="" placeholder ="Your Message" class="in_fld"></textarea></p>
                    <p>
                        <input type="submit" name="" id="" value="send" class="submit_btn">
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <h4  class="footer_heading">QUICK LINKS</h4>
                <ul class="faq_list">
                    <li style="border-bottom:none"><a href="http://www.yellowalley.org/faqs/">FAQ’s</a></li>
                    <li style="border-bottom:none"><a href="http://www.yellowalley.org/privacy-policy/">Privacy Policy</a></li>
                    <li><a href="http://www.yellowalley.org/terms-conditions/">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-xs-12 address_con">
                <h4  class="footer_heading">CONTACT US</h4>
                <div class="address ralewy_font">
                    <label for="" class="ralewy_font"><i class="fa fa-map-marker" aria-hidden="true"></i> Address:</label>
                    <p class="ralewy_font">ANSARI ROAD, NEW DELHI - 110002</p>
</div>
<ul>
    <li class="ralewy_font"><i class="fa fa-phone" aria-hidden="true"></i>Phone: 8595205921</li>
    <li class="ralewy_font"><i class="fa fa-envelope"></i>Email: info@yellowalley.org</li>
</ul>
            </div>
        </div>


            <!-- <div class="row section">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <h3>About Yellow Alleyyy</h3>
                    <p class="text-white text-justify">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
                        <a href="pages/ab out">read more ></a>
                    </p>
                </div> -->
                <!-- <div class="col-lg-3 col-md-3 col-xs-12">
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
                </div> -->
                <!-- <div class="col-lg-5 col-md-5 col-xs-12">
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
                </div> -->
                <!-- <hr> -->
                <!-- <div class="col-12">
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
                </div> -->
            </div>

        </div>
        <div class="privacy_policy">
            <div class="copy_right">
            2019 © Copyrights Yellow Alley Designed By Relesh Infomedia
            </div>
            <div class="faq_footer">
                <ul>
                    <li><a href="http://www.yellowalley.org/faqs/">FAQ’s</a></li>
                    <li><a href="http://www.yellowalley.org/privacy-policy/">Privacy Policy</a></li>
                    <li><a href="http://www.yellowalley.org/terms-conditions/" style="border:none !important">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="socail_footer">
            <div class="social_icon f_social">
        <ul>
        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
        </ul>
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
<script>

</script>
<script>
     $('.my_search').click(function(){

        $(".menu-item").toggleClass("active")

   })

   $(document).ready(function(){
    $(window).scroll(function(){
       alert(111);

    if ($(window).scrollTop() >= 300) {

        $('.nav1').addClass('fixed-header');

    }
    else {
        $('.nav1').removeClass('fixed-header');

    }
});

   });


</script>
<style>
      .btn-blms:hover{
    color:#fff !important;
    border: 2px solid #231f20;
    background: #000 !important;
}
</style>

@yield('scripts')


</body>

</html>
