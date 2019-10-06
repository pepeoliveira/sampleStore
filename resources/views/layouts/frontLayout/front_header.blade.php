@php
    // CORRIGIR PARA INJECT ***********************************************
        use App\Http\Controllers\Controller;
        $mainCategories = Controller::MainCategories()

@endphp

<header id="header"><!--header-->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item text-center">
                <span class="text-center"><img src="{{ asset('images/frontend_images/Sport-TV.png') }}" alt="sportTv" style="margin-right: 20px"><strong>Football is everything. Sport TV has a new smart channel to improve your experience.</strong></span>
            </div>
            <div class="item  text-center">
                <span class="text-center"><img src="{{ asset('images/frontend_images/sky-sports.png') }}" alt="sportTv" style="margin-right: 20px"><strong>The fight for the Premier League title is hot. Connect with us and follow your favorite team closely.</strong></span>
            </div>
            <div class="item  active text-center">
                <span class="text-center"><span style="padding: 2px; margin-top: 5px; margin-bottom: 5px;  color: red; border-radius: 5px; margin-right: 20px">FREE SHIPPING</span><strong>You only need <b>€60</b> to Get FREE SHIPPING! </strong><span style="padding: 2px; margin-top: 5px; margin-bottom: 5px;  color: red; border-radius: 5px; margin-left: 20px">FREE SHIPPING</span></span>
            </div>
        </div>

{{--        <!-- Left and right controls -->--}}
{{--        <a class="left carousel-control" href="#myCarousel" data-slide="prev">--}}
{{--            <span class="glyphicon glyphicon-chevron-left"></span>--}}
{{--            <span class="sr-only">Previous</span>--}}
{{--        </a>--}}
{{--        <a class="right carousel-control" href="#myCarousel" data-slide="next">--}}
{{--            <span class="glyphicon glyphicon-chevron-right"></span>--}}
{{--            <span class="sr-only">Next</span>--}}
{{--        </a>--}}
    </div>
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +351 91 89 71 461</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> helpdesk@sportseshopper.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{ asset('images/frontend_images/home/logo3.png') }}" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Europe
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">America</a></li>
                                <li><a href="#">UK</a></li>
                                <li><a href="#">South Asia</a></li>
                                <li><a href="#">Australia</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Euro
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">American Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                                <li><a href="#">SGP Dollar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            @if(empty(Auth::check()))

                                <li><a href="{{url('/page/contact')}}"><i class="fas fa-phone-alt"></i> Contact Us</a>
                                </li>
                                <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @else
                                <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="{{url('/orders')}}"><i class="fa fa-crosshairs"></i> Orders</a></li>
                                <li><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{url('/page/contact')}}"><i class="fas fa-phone-alt"></i> Contact Us</a>
                                </li>
                                <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="row" style="background-color:#003C71;">
                            <div class="col-12">
                                <ul class="nav navbar-nav collapse navbar-collapse mainmenu">
                                    <li><a href="/"><i  style="font-size: 15px; color:#FFFFFF!important;" class="fas fa-home"></i></a></li>
                                    @foreach($mainCategories as $category)
                                        @if($category->status==1)
                                            <li>
                                                <a style="font-size: 15px; color:#FFFFFF!important;"
                                                   href="{{ asset('products/'.$category->url) }}">{{ $category->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <div class="pull-right" style="margin-left: 10px; margin-top: 10px">
                                        <div class="search_box pull-right" style="color: #003C71">
                                            <input type="text" placeholder="Search" style="color: #003C71"/>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </div><!--/header-middle-->
</header><!--/header-->
