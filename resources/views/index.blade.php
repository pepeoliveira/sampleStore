@extends('layouts.frontLayout.front_design')

@section('content')

    <section id="slider" ><!--slider-->
        <div class="container" >
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>   {!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>   {!! session('flash_message_success') !!}</strong>
                </div>
            @endif
            <div class="row" >
                <div class="col-sm-12" >
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel" style="border-top: 1px solid darkblue; border-bottom: 1px solid darkblue">
                        <ol class="carousel-indicators">
                            @foreach($banners as $key => $banner)
                                <li data-target="#slider-carousel" data-slide-to="0"
                                    @if($key==0) class="active" @endif></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach($banners as $key => $banner)
                                <div class="item @if($key==0) active @endif">
                                    <a style="" href="{{$banner->link }}" title="{{ $banner->title }}">
                                        <img  src="images/frontend_images/banners/{{$banner->image}}">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('layouts.frontLayout.front_sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">All Items</h2>

                        @foreach($productsAll as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img
                                                src="{{ asset('images/backend_images/products/small/'.$product->image) }}"
                                                alt=""/>
                                            <h2>€ {{ $product->price }}</h2>
                                            <p>{{ $product->product_name }}</p>
{{--                                            @foreach($subcategories as $subcategory)--}}
                                            <a href="{{ url('product/'.$product->id) }}" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
{{--                                            @endforeach--}}
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="{{ url('/orders') }}"><i class="fa fa-plus-square"></i>Check your orders page</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <div align="center">{{ $productsAll->links() }}</div>


                    </div><!--features_items-->

                </div>
            </div>
        </div>
    </section>

@endsection
