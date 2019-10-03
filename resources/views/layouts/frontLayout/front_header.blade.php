@php
    // CORRIGIR PARA INJECT ***********************************************
        use App\Http\Controllers\Controller;
        $mainCategories = Controller::MainCategories()

@endphp

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +351 91 89 71 461</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> hugoTenhoUmaDuvida@gmail.com</a></li>
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
                        <a href="index.html"><img src="{{ asset('images/frontend_images/home/logo3.png') }}" alt="" /></a>
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
                            <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if(empty(Auth::check()))
                                <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @else
                                <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="#" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($mainCategories as $category)
                                            @if($category->status=="1")
                                                <li>
                                                    <a href="{{ asset('products/'.$category->url) }}">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
{{--                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>--}}
{{--                                    <ul role="menu" class="sub-menu">--}}
{{--                                        <li><a href="blog.html">Blog List</a></li>--}}
{{--                                        <li><a href="blog-single.html">Blog Single</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
                                <li><a href="404.html">404</a></li>
                                <li><a href="contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right" style="color: #003C71">
                            <input type="text" placeholder="Search" style="color: #003C71"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </div><!--/header-middle-->
</header><!--/header-->
