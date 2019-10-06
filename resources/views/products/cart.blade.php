@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
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
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu"  style="background-color: #0072B6">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total_amount =0;
                    @endphp
                    @foreach($userCart as $cart)

                    <tr>
                        <td class="cart_product">
                            <a href=""><img style="width:100px; border: 1px solid black"  src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $cart->product_name }}</a></h4>
                            <p>{{ $cart->product_code }} | {{ $cart->size }}</p>
                        </td>
                        <td class="cart_price" >
                            <p>€ {{ $cart->price }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
                                @if($cart->quantity>1)
                                    <a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
                                @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p  style="color: #0072B6" class="cart_total_price">€ {{ $cart->price*$cart->quantity }}</p>
                        </td>
                        <td class="cart_delete">
                            <a  style="color: red"class="cart_quantity_delete" href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @php $total_amount = $total_amount + ($cart->price * $cart->quantity)@endphp
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <input type="checkbox" required>&nbsp <i class="fas fa-exclamation" style="color: red"></i>&nbsp I confirm that i have read and accept the terms of the Privacy Policy.
                </div>

                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Total <span>€ {{ $total_amount }}</span></li>
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{ url('/checkout') }}">Check Out</a>
                    </div>
                </div>

            </div>
        </div>
    </section><!--/#do_action-->

@endsection
