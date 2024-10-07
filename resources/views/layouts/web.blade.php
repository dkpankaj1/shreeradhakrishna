<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cortex IT Solution">

    <!-- Page Title -->
    <title> SRKE - Shree Radha Krishna Energy </title>

    <!-- Favicon and Touch Icons -->
    <link href="{{ asset('frontend') }}/favicon.ico" rel="shortcut icon" type="image/png">

    <!-- Icon fonts -->
    <link href="{{ asset('frontend') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/flaticon.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Plugins for this template -->
    <link href="{{ asset('frontend') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/owl.theme.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/slick.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/slick-theme.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/owl.transitions.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/jquery.fancybox.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/jquery.mCustomScrollbar.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <div class="preloader">
            <div class="preloader-inner">
                <img src="{{ asset('frontend') }}/images/preloader.gif" alt>
            </div>
        </div>
        <!-- end preloader -->


        <!-- Start header -->
        <header id="header" class="site-header header-style-1">
            <div class="topbar topbar-style-1">
                <div class="container">
                    <div class="row">
                        <div class="col col-sm-2">
                            <div class="site-logo">
                                <a href="index.html"><img src="{{ asset('frontend') }}/logo.png" alt></a>
                            </div>
                        </div>
                        <div class="col col-sm-10">
                            <div class="topbar-contact-info-wrapper">
                                <div class="topbar-contact-info">
                                    <div>
                                        <i class="fa fa-location-arrow"></i>
                                        <div class="details">
                                            <p>NH 27 Madhopur Bujurg, TamkuhiRaj</p>
                                            <span>Kushinagar,Uttar Pradesh 274406</span>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-phone"></i>
                                        <div class="details">
                                            <p>+91-9953730559</p>
                                            <span>arvindyadav.1072@rediffmail.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div> <!-- end topbar -->

            <nav class="navigation navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navigation-holder">
                        <button class="close-navbar"><i class="fa fa-close"></i></button>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div><!-- end of nav-collapse -->

                    <div class="cart-contact">
                        <div class="get-quote">
                            <a href="{{ route('login') }}" class="theme-btn">Login</a>
                        </div>
                    </div>

                </div><!-- end of container -->
            </nav> <!-- end navigation -->
        </header>
        <!-- end of header -->

        {{ $slot }}

        <!-- start site-footer -->
        <footer class="site-footer">
            <div class="upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-md-6 col-sm-6">
                            <div class="widget about-widget">
                                <div class="footer-logo"><img src="{{ asset('frontend') }}/logo.png" alt>
                                </div>
                                <ul class="contact-info">
                                    <li><i class="fa fa-home"></i>NH27 Madhopur Bujurg, TamkuhiRaj</li>
                                    <li><i class="fa fa-phone"></i>+91-9953730559</li>
                                    <li><i class="fa fa-home"></i> Working Hours: <br>Mon-Sun (6 am - 11 pm)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-md-6 col-sm-6">
                            <div class="widget quick-links-widget">
                                <h3>Navigation</h3>
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end upper-footer -->
            <div class="copyright-info">
                <div class="container">
                    <p>2024 &copy; All Rights Reserved by <a href="#">Shree Radha Krishna Energy</a></p>
                </div>
            </div>
        </footer>
        <!-- end site-footer -->
    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('frontend') }}/js/jquery-plugin-collection.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.mCustomScrollbar.js"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('frontend') }}/js/script.js"></script>
    @stack('script')
</body>

</html>
