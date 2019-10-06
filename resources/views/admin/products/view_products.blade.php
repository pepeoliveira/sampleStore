@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Products</a> </div>
            <h1>Products</h1>
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
                            <h5>View Products</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th style="font-size: 12px">ID</th>
                                    <th style="font-size: 12px">CATEGORY NAME</th>
                                    <th style="font-size: 12px">PRODUCT NAME</th>
                                    <th style="font-size: 12px">PRODUCT CODE</th>
                                    <th style="font-size: 12px">PRODUCT COLOR</th>
                                    <th style="font-size: 12px">DESCRIPTION</th>
                                    <th style="font-size: 12px">PRICE</th>
                                    <th style="font-size: 12px">IMAGE</th>
                                    <th style="font-size: 12px">ACTIONS </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="gradeX">
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td><strong>{{ $product->product_name }}</strong></td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_color }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }} €</td>
                                        <td width="6%">
                                            <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}">

                                        </td>
                                        <td class="ml-5 text-center">
                                            <a class="btn btn-mini btn-primary" style="margin-top: 5px;" href="{{ url('admin/add-attributes/'.$product->id) }}">
                                                Attributes / Stock</a>
                                            <br>
                                            <a class="btn btn-mini btn-success mt-2" style="margin-top: 5px;" href="{{ url('admin/add-images/'.$product->id) }}">
                                                Add Images</a>
                                            <br>
                                            <a class="btn btn-mini btn-warning mt-2" style="margin-top: 5px;" href="{{ url('admin/edit-product/'.$product->id) }}" > Edit Product</a>
                                            <br>
                                            <a class="btn btn-mini btn-danger" style="margin-top: 5px;" data-toggle="modal" data-target="#delete-{{$product->id}}">
                                                Delete Product</a>

                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade modal-sm" id="delete-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <button style="margin-right:15px; margin-top: 10px; color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="modal-header">
                                                    <p style="font-size:20px; margin-top:15px;" class="modal-title text-center"  id="exampleModalLabel"><b>DELETE PRODUCT: {{$product->product_name}}</b></p>

                                                </div>
                                                <div class="modal-body text-center">
                                                    <p style="font-size: 30px; margin-top: 30px;">Are you sure?</p>
                                                    <img style="width:100px; margin-bottom: 30px; margin-top: 30px;" class= "img-responsive" src="{{asset('/images/backend_images/delete.png')}}">
                                                    <p style="font-size: 20px;">Do you really want to delete this product?
                                                        <br> This process cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                    <a class="btn btn-danger text-danger"  href="{{ url('admin/delete-product/'.$product->id) }}">
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
