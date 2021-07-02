<!-- Navigation Area
===================================== -->
<nav class="navbar navbar-pasific navbar-mp megamenu navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <img src="{{ asset('frontend/assets/img/logo/logo-default.png') }}" alt="logo">
                Pen-It
            </a>
        </div>

        <div class="navbar-collapse collapse navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{route('blogs.home')}}" class="color-light">Home </a>
                </li>
                @if(auth()->check())
                    <li>
                        <a href="{{route('dashboard')}}"  class="color-light">Dashboard </a>
                    </li>
                @else
                    <li>
                        <a href="{{route('login')}}"  class="color-light">Login </a>
                    </li>
                    <li>
                        <a href="{{route('register')}}"  class="color-light">Sign Up </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>
