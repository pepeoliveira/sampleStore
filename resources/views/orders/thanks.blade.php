@extends('layouts.frontLayout.front_design')
@section('content')

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
                <p>Your number order is @php $random = rand(10000,99999) @endphp <strong>{{ $random }}</strong>, and total payable is <strong style="color: blue">€ {{ Session::get('payment') }}</strong>  </p>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection


@php
    Session::forget('order_id');
Session::forget('payment');

@endphp
