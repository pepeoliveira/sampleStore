@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
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
{{--                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">--}}
{{--                    <input type="hidden" name="cmd" value="_s-xclick">--}}
{{--                    <input type="hidden" name="business" value="sb-sjuoq340612@business.example.com">--}}
{{--                    <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">--}}
{{--                    <input type="hidden" name="currency_code" value="EUR">--}}
{{--                    <input type="hidden" name="amount" value="{{ Session::get('payment') }}">--}}
{{--                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">--}}
{{--                    <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">--}}
{{--                </form>--}}
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

                    <!-- Saved buttons use the "secure click" command -->
                    <input type="hidden" name="cmd" value="_s-xclick">

                    <!-- Saved buttons are identified by their button IDs -->
                    <input type="hidden" name="hosted_button_id" value="221">

                    <!-- Saved buttons display an appropriate button image. -->
                    <input type="image" name="submit"
                           src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                           alt="PayPal - The safer, easier way to pay online">
                    <img alt="" width="1" height="1"
                         src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

                </form>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection


@php
    Session::forget('order_id');
Session::forget('payment');

@endphp
