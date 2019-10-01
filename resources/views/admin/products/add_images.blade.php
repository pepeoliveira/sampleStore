@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"><a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Products</a>
                <a href="#" class="current">Add Product Images</a>
            </div>
            <h1>Product Alternate Images</h1>
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
                        <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Product Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-images/'.$productDetails->id) }}" name="add_product" id="add_product" novalidate="novalidate">{{ csrf_field() }}

                                {{--                                <form enctype="multipart/form-data" class="form-horizontal" method="post"--}}
                                {{--                                  action="{{ url('/admin/add-images/'.$productDetails->id) }}" name="add_image"--}}
                                {{--                                  id="add_image" novalidate="novalidate">{{ csrf_field() }}--}}
                                <input type="hidden" style="display: none;" type="text" value="{{$productDetails->id}}" name="product_id">
                                <div class="control-group">
                                    <label class="control-label">Category Name: </label>
                                    <label class="control-label"><strong style="float: left; margin-left: 10px;">{{ $category_name }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Name: </label>
                                    <label class="control-label"><strong style="float: left; margin-left: 10px;">{{ $productDetails->product_name }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code: </label>
                                    <label class="control-label"><strong style="float: left;  margin-left: 10px;">{{ $productDetails->product_code }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Alternate Image(s)</label>
                                    <div class="controls">
                                        <input type="file" name="image[]" id="image" multiple="multiple">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Images" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                            <h5>View Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th style="font-size: 12px">IMAGE ID</th>
                                    <th style="font-size: 12px">PRODUCT ID</th>
                                    <th style="font-size: 12px">IMAGE</th>
                                    <th style="font-size: 12px">ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productImages as $image)
                                    <tr class="gradeX">
                                        <td class="center">{{ $image->id }}</td>
                                        <td class="center">{{ $image->product_id }}</td>
                                        <td class="center"><img width=130px src="{{ asset('images/backend_images/products/small/'.$image->image) }}"></td>
                                        <td class="center"><a id="delImage" rel="{{ $image->id }}" rel1="delete-alt-image" href="javascript:" class="btn btn-danger btn-mini deleteAltImage">Delete</a></td>

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

@endsection
