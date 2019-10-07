@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"><a href="{{ url('/orders') }}">Orders</a></li>
                    <li class="active">{{ $orderDetails->name }}</li>
                </ol>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails->orders as $pro)
                        <tr>
                            <td>{{ $pro->product_code }}</td>
                            <td>{{ $pro->product_name }}</td>
                            <td>{{ $pro->product_size }}</td>
                            <td>{{ $pro->product_color }}</td>
                            <td>€ {{ $pro->product_price }}</td>
                            <td>{{ $pro->product_quantity }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection
