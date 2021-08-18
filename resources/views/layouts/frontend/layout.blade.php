<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/assets/img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('frontend/assets/img/apple-touch-icon-114x114.png') }}">

    <!-- Load Core CSS
    =====================================-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/core/bootstrap-3.3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/core/animate.min.css') }}">

    <!-- Load Main CSS
    =====================================-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main/setting.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main/hover.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/assets/css/color/pasific.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/icon/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/icon/et-line-font.css') }}">
    @yield('page-level-styles')
    <!-- Load JS
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    WARNING: Respond.js doesn't work if you view the page via file://
    =====================================-->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="topPage" data-spy="scroll" data-target=".navbar" data-offset="100">



    <!-- Page Loader
===================================== -->
    <div id="pageloader" class="bg-grad-animation-1">
        <div class="loader-item">
            <img src="{{ asset('frontend/assets/img/other/oval.svg') }}" alt="page loader">
        </div>
    </div>

    <a href="#page-top" class="go-to-top">
        <i class="fa fa-long-arrow-up"></i>
    </a>

    @include('layouts.frontend.partials._navigation')
    @yield('header')

    <!-- Blog Area
===================================== -->
    <div id="blog" class="pt20 pb50">
        <div class="container">

            <div class="row">
                <div class="col-md-9 mt25">


                    @yield('main-content')

                </div>

                @include('layouts.frontend.partials._sidebar')

            </div>

        </div>
    </div>


    @include('layouts.frontend.partials._newsletter')

    @include('layouts.frontend.partials._footer')

    <!-- JQuery Core
=====================================-->
    <script src="{{ asset('frontend/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/core/bootstrap-3.3.7.min.js') }}"></script>

    <!-- Magnific Popup
=====================================-->
    <script src="{{ asset('frontend/assets/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/magnific-popup/magnific-popup-zoom-gallery.js') }}"></script>

    <!-- JQuery Main
=====================================-->
    <script src="{{ asset('frontend/assets/js/main/jquery.appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main/parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main/jquery.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main/main.js') }}"></script>
    @yield('page-level-scripts')
</body>

</html>
