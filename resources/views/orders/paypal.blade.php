@extends('layouts.frontLayout.front_design')
@section('content')
@php use App\Order @endphp
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Thanks</li>
                </ol>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <h1>Your COD order has been placed.</h1>
                <h1><i class="fas fa-3x fa-check-circle" style="color: green"></i></h1><br>
                <p>Your number order is {{ Session::get('order_id') }} and total payable is <strong style="color: blue">€ {{ Session::get('payment') }}</strong>  </p>
                <p>Please make payment by clicking on below Payment Button </p>
                @php $orderDetails = Order::getOrderDetails(Session::get('order_id'));
                    $getCountryCode = Order::getCountryCode($orderDetails->country);

                @endphp
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> {{ csrf_field() }}
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="hugoliveira.0@gmail.com">
                    <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="amount" value="{{ Session::get('payment') }}">
                    <input type="hidden" name="first_name" value="{{ $orderDetails->name }}">
                    <input type="hidden" name="address1" value="{{ $orderDetails->address }}">
                    <input type="hidden" name="city" value="{{ $orderDetails->city }}">
                    <input type="hidden" name="zip" value="{{ $orderDetails->zipcode }}">
                    <input type="hidden" name="email" value="{{ $orderDetails->user_email }}">
                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
                    <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection


@php
    Session::forget('order_id');
Session::forget('payment');

@endphp
