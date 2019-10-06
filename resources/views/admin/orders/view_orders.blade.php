@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Orders</a> <a href="#" class="current">View Orders</a> </div>
            <h1>Orders</h1>
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
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Orders</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th style="font-size: 12px">ID</th>
                                    <th style="font-size: 12px">ORDER DATE</th>
                                    <th style="font-size: 12px">CUSTOMER NAME</th>
                                    <th style="font-size: 12px">CUSTOMER EMAIL</th>
                                    <th style="font-size: 12px">ORDERED PRODUCTS</th>
                                    <th style="font-size: 12px">ORDER AMOUNT</th>
                                    <th style="font-size: 12px">ORDER STATUS</th>
                                    <th style="font-size: 12px">PAYMENT METHOD</th>
                                    <th style="font-size: 12px">ACTIONS </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr class="gradeX">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td><strong>{{ $order->name }}</strong></td>
                                        <td>{{ $order->user_email }}</td>
                                        <td>
                                            @foreach($order->orders as $product)
                                                {{$product->product_code}}
                                                {{$product->product_quantity}}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->payment }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td class="center">
                                            <a target="_blank" href="{{ url('admin/view-order/'.$order->id)}}" class="btn btn-primary btn-mini">View Order Details</a><br><br>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>



@endsection
